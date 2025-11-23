<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        $cars->load(['specification', 'rentalPrice']);
        return Inertia::render('Admin/Mobil/Index', [
            'cars' => $cars,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Mobil/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'url_foto_mobil' => 'required|array',
            'nama_mobil' => 'required',
            'ketersediaan' => 'required|numeric',
            // spesifikasi
            'kapasitas' => 'required|numeric',
            'kategori' => 'required|string',
            'fasilitas' => 'required|array',
            'jenis_transmisi' => 'required|string',
            // harga sewa
            'harga_solo' => 'required|numeric',
            'harga_solo_raya' => 'required|numeric',
            'harga_luar_kota' => 'required|numeric',
        ]);

        // ✅ Pastikan kategori valid untuk ENUM
        $allowedKategori = [
            'MPV',
            'SUV',
            'Large SUV',
            'MPV Luxury',
            'MiniBus',
            'Luxury Minibus'
        ];

        $kategori = in_array($request->kategori, $allowedKategori)
            ? $request->kategori
            : 'MPV'; // fallback kalau user kirim "Sedan" atau nilai lain

        // ✅ Simpan foto mobil
        $path = [];
        foreach ($request->file('url_foto_mobil') as $image) {
            $path[] = $image->storeAs('mobil', $image->hashName());
        }

        // ✅ Buat data mobil
        $mobil = Car::create([
            'nama_mobil' => $validated['nama_mobil'],
            'url_foto_mobil' => json_encode($path),
            'ketersediaan' => $validated['ketersediaan'],
        ]);

        // ✅ Simpan spesifikasi
        $mobil->specification()->create([
            'jenis_transmisi' => $validated['jenis_transmisi'],
            'kapasitas' => $validated['kapasitas'],
            'kategori' => $kategori, // ← sudah aman dan sesuai ENUM
            'fasilitas' => json_encode($validated['fasilitas']),
        ]);

        // ✅ Simpan harga sewa
        $mobil->rentalPrice()->create([
            'harga_solo' => $validated['harga_solo'],
            'harga_solo_raya' => $validated['harga_solo_raya'],
            'harga_luar_kota' => $validated['harga_luar_kota'],
        ]);

        return redirect()
            ->route('admin.mobil.index')
            ->with('success', 'Mobil berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mobil = Car::findOrFail($id);
        $mobil->load(['specification', 'rentalPrice']);

        return Inertia::render('Admin/Mobil/Show', [
            'mobil' => $mobil,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mobil = Car::findOrFail($id);
        $mobil->load(['specification', 'rentalPrice']);

        return Inertia::render('Admin/Mobil/Edit', [
            'mobil' => $mobil,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mobil = Car::findOrFail($id);

        $validated = $request->validate([
            // Validasi untuk foto baru (menggunakan nama field 'new_photos' dari frontend)
            'new_photos' => 'nullable|array',
            'new_photos.*' => 'image|mimes:jpeg,png,jpg|max:5120', // Maks 5MB

            // Validasi untuk foto lama yang akan dihapus
            'deleted_photos' => 'nullable|array',

            'nama_mobil' => 'nullable|string|max:255',
            'ketersediaan' => 'nullable|numeric|min:0',

            'kapasitas' => 'nullable|numeric|min:1',
            'kategori' => 'nullable|string|max:50',
            'fasilitas' => 'nullable|array',
            'fasilitas.*' => 'string|max:255',
            'jenis_transmisi' => 'nullable|string|max:50',

            'harga_solo' => 'nullable|numeric|min:0',
            'harga_solo_raya' => 'nullable|numeric|min:0',
            'harga_luar_kota' => 'nullable|numeric|min:0',
        ]);

        // 1. Inisialisasi daftar foto yang sudah ada di database
        $currentPhotoPaths = json_decode($mobil->url_foto_mobil, true) ?? [];
        $deletedPhotos = $request->input('deleted_photos', []);

        // 2. Hapus foto lama yang ditandai untuk dihapus (dari frontend)
        if (!empty($deletedPhotos)) {
            foreach ($deletedPhotos as $pathToDelete) {
                // Pastikan path yang dihapus ada di storage
                if (Storage::disk('public')->exists($pathToDelete)) {
                    Storage::disk('public')->delete($pathToDelete);
                }
            }
            // Filter path foto lama yang dihapus dari daftar saat ini
            $currentPhotoPaths = array_filter($currentPhotoPaths, function ($path) use ($deletedPhotos) {
                return !in_array($path, $deletedPhotos);
            });
        }

        // 3. Upload dan simpan path foto baru (dari field 'new_photos')
        $newPhotoPaths = [];
        if ($request->hasFile('new_photos')) {
            foreach ($request->file('new_photos') as $image) {
                // Simpan ke direktori 'mobil' di public disk
                $newPhotoPaths[] = $image->store('mobil', 'public');
            }
        }

        // 4. Gabungkan foto yang tersisa dan foto baru
        $finalPhotoPaths = array_merge($currentPhotoPaths, $newPhotoPaths);
        $mobil->url_foto_mobil = json_encode(array_values($finalPhotoPaths)); // array_values untuk mereset key array

        // 5. Update data utama mobil
        $mobil->nama_mobil = $request->nama_mobil ?? $mobil->nama_mobil;
        $mobil->ketersediaan = $request->ketersediaan ?? $mobil->ketersediaan;
        $mobil->save();

        // 6. Update spesifikasi (jika relasi ada)
        if ($mobil->specification) {
            $mobil->specification()->update([
                'jenis_transmisi' => $request->jenis_transmisi ?? $mobil->specification->jenis_transmisi,
                'kapasitas' => $request->kapasitas ?? $mobil->specification->kapasitas,
                'kategori' => $request->kategori ?? $mobil->specification->kategori,
                'fasilitas' => isset($request->fasilitas)
                    ? json_encode(array_values(array_filter($request->fasilitas))) // Filter nilai kosong
                    : $mobil->specification->fasilitas,
            ]);
        }

        // 7. Update harga sewa (jika relasi ada)
        if ($mobil->rentalPrice) {
            $mobil->rentalPrice()->update([
                'harga_solo' => $request->harga_solo ?? $mobil->rentalPrice->harga_solo,
                'harga_solo_raya' => $request->harga_solo_raya ?? $mobil->rentalPrice->harga_solo_raya,
                'harga_luar_kota' => $request->harga_luar_kota ?? $mobil->rentalPrice->harga_luar_kota,
            ]);
        }

        return redirect()->route('admin.mobil.index')->with('success', 'Data mobil berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mobil = Car::findOrFail($id);

        foreach (json_decode($mobil->url_foto_mobil) as $gambar) {
            $imagePath = 'storage/mobil/' . basename($gambar);

            if (file_exists($imagePath))
                unlink($imagePath);
        }

        $mobil->specification()->delete();
        $mobil->rentalPrice()->delete();
        $mobil->delete();

        return redirect()->route('admin.mobil.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
