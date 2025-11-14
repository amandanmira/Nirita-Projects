<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
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
            'plat_nomor' => 'required|unique:cars,plat_nomor',
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
            'plat_nomor' => $validated['plat_nomor'],
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
            'url_foto_mobil' => 'nullable|array',
            'url_foto_mobil.*' => 'image|mimes:jpeg,png,jpg|max:5120',
            'nama_mobil' => 'nullable|string',
            'plat_nomor' => 'nullable|string|unique:cars,plat_nomor,' . $mobil->id_mobil . ',id_mobil',
            'ketersediaan' => 'nullable|numeric',

            'kapasitas' => 'nullable|numeric',
            'kategori' => 'nullable|string',
            'fasilitas' => 'nullable|array',
            'jenis_transmisi' => 'nullable|string',

            'harga_solo' => 'nullable|numeric',
            'harga_solo_raya' => 'nullable|numeric',
            'harga_luar_kota' => 'nullable|numeric',
        ]);

        // 🔹 1. Update Foto Mobil
        if ($request->hasFile('url_foto_mobil')) {
            // Hapus foto lama
            $fotoLama = json_decode($mobil->url_foto_mobil, true);
            if (is_array($fotoLama)) {
                foreach ($fotoLama as $gambar) {
                    $imagePath = storage_path('app/public/' . $gambar);
                    if (file_exists($imagePath)) unlink($imagePath);
                }
            }

            // Simpan foto baru
            $pathBaru = [];
            foreach ($request->file('url_foto_mobil') as $image) {
                $pathBaru[] = $image->store('mobil', 'public');
            }
            $mobil->url_foto_mobil = json_encode($pathBaru);
        }

        // 🔹 2. Update data utama mobil
        $mobil->nama_mobil = $request->nama_mobil ?? $mobil->nama_mobil;
        $mobil->plat_nomor = $request->plat_nomor ?? $mobil->plat_nomor;
        $mobil->ketersediaan = $request->ketersediaan ?? $mobil->ketersediaan;
        $mobil->save();

        // 🔹 3. Update spesifikasi
        if ($mobil->specification) {
            $mobil->specification()->update([
                'jenis_transmisi' => $request->jenis_transmisi ?? $mobil->specification->jenis_transmisi,
                'kapasitas' => $request->kapasitas ?? $mobil->specification->kapasitas,
                'kategori' => $request->kategori ?? $mobil->specification->kategori,
                'fasilitas' => isset($request->fasilitas)
                    ? json_encode($request->fasilitas)
                    : $mobil->specification->fasilitas,
            ]);
        }

        // 🔹 4. Update harga sewa
        if ($mobil->rentalPrice) {
            $mobil->rentalPrice()->update([
                'harga_solo' => $request->harga_solo ?? $mobil->rentalPrice->harga_solo,
                'harga_solo_raya' => $request->harga_solo_raya ?? $mobil->rentalPrice->harga_solo_raya,
                'harga_luar_kota' => $request->harga_luar_kota ?? $mobil->rentalPrice->harga_luar_kota,
            ]);
        }

        return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil diperbarui.');


        // $validated = $request->validate([
        //     'url_foto_mobil' => 'nullable|array',
        //     'nama_mobil' => 'required',
        //     'plat_nomor' => 'required|unique:cars,plat_nomor,' . $mobil->id_mobil . ',id_mobil',
        //     'ketersediaan' => 'required|numeric',
        //     // spesifikasi
        //     'kapasitas' => 'required|numeric',
        //     'kategori' => 'required',
        //     'fasilitas' => 'required|array',
        //     'jenis_transmisi' => 'required',
        //     // harga sewa
        //     'harga_solo' => 'required|numeric',
        //     'harga_solo_raya' => 'required|numeric',
        //     'harga_luar_kota' => 'required|numeric',
        // ]);

        // $fasilitas = $validated['fasilitas'];

        // if ($request->hasFile('url_foto_mobil')) {
        //     foreach (json_decode($mobil->url_foto_mobil) as $gambar) {
        //         $imagePath = 'storage/mobil/' . basename($gambar);

        //         if (file_exists($imagePath))
        //             unlink($imagePath);
        //     }

        //     $path = [];
        //     foreach ($request->file('url_foto_mobil') as $image)
        //         $path[] = $image->storeAs('mobil', $image->hashName());

        //     $mobil->update([
        //         'nama_mobil' => $request->nama_mobil,
        //         'url_foto_mobil' => $path,
        //         'plat_nomor' => $request->plat_nomor,
        //         'ketersediaan' => $request->ketersediaan,
        //     ]);

        //     $mobil->specification()->update([
        //         'jenis_transmisi' => $request->jenis_transmisi,
        //         'kapasitas' => $request->kapasitas,
        //         'kategori' => $request->kategori,
        //         'fasilitas' => json_encode($fasilitas),
        //     ]);

        //     $mobil->rentalPrice()->update([
        //         'harga_solo' => $request->harga_solo,
        //         'harga_solo_raya' => $request->harga_solo_raya,
        //         'harga_luar_kota' => $request->harga_luar_kota,
        //     ]);
        // } else {
        //     $mobil->update($request->only('nama_mobil', 'plat_nomor', 'ketersediaan', 'deskripsi'));

        //     $mobil->specification()->update([
        //         'jenis_transmisi' => $request->jenis_transmisi,
        //         'kapasitas' => $request->kapasitas,
        //         'kategori' => $request->kategori,
        //         'fasilitas' => json_encode($fasilitas),
        //     ]);

        //     $mobil->rentalPrice()->update([
        //         'harga_solo' => $request->harga_solo,
        //         'harga_solo_raya' => $request->harga_solo_raya,
        //         'harga_luar_kota' => $request->harga_luar_kota,
        //     ]);
        // }

        // return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil diperbarui.');
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
