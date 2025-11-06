<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::all();
        $cars->load(['specification', 'rentalPrice']);
        return view('admin.mobil.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mobil.create');
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
            'kategori' => 'required',
            'fasilitas' => 'required|array',
            'jenis_transmisi' => 'required',
            // harga sewa
            'harga_solo' => 'required|numeric',
            'harga_solo_raya' => 'required|numeric',
            'harga_luar_kota' => 'required|numeric',
        ]);

        $path = [];
        foreach ($request->file('url_foto_mobil') as $image)
            $path[] = $image->storeAs('mobil', $image->hashName());


        $fasilitas = $validated['fasilitas'];

        $mobil = Car::create([
            'nama_mobil' => $request->nama_mobil,
            'url_foto_mobil' => json_encode($path),
            'plat_nomor' => $request->plat_nomor,
            'ketersediaan' => $request->ketersediaan,
        ]);

        $mobil->specification()->create([
            'jenis_transmisi' => $request->jenis_transmisi,
            'kapasitas' => $request->kapasitas,
            'kategori' => $request->kategori,
            'fasilitas' => json_encode($fasilitas),
        ]);

        $mobil->rentalPrice()->create([
            'harga_solo' => $request->harga_solo,
            'harga_solo_raya' => $request->harga_solo_raya,
            'harga_luar_kota' => $request->harga_luar_kota,
        ]);

        return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mobil = Car::findOrFail($id);
        $mobil->load(['specification', 'rentalPrice']);

        return view('admin.mobil.show', compact('mobil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mobil = Car::findOrFail($id);
        $mobil->load(['specification', 'rentalPrice']);

        return view('admin.mobil.edit', compact('mobil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $mobil = Car::findOrFail($id);

        $validated = $request->validate([
            'url_foto_mobil' => 'nullable|array',
            'nama_mobil' => 'required',
            'plat_nomor' => 'required|unique:cars,plat_nomor,' . $mobil->id_mobil . ',id_mobil',
            'ketersediaan' => 'required|numeric',
            // spesifikasi
            'kapasitas' => 'required|numeric',
            'kategori' => 'required',
            'fasilitas' => 'required|array',
            'jenis_transmisi' => 'required',
            // harga sewa
            'harga_solo' => 'required|numeric',
            'harga_solo_raya' => 'required|numeric',
            'harga_luar_kota' => 'required|numeric',
        ]);

        $fasilitas = $validated['fasilitas'];

        if ($request->hasFile('url_foto_mobil')) {
            foreach (json_decode($mobil->url_foto_mobil) as $gambar) {
                $imagePath = 'storage/mobil/' . basename($gambar);

                if (file_exists($imagePath))
                    unlink($imagePath);
            }

            $path = [];
            foreach ($request->file('url_foto_mobil') as $image)
                $path[] = $image->storeAs('mobil', $image->hashName());

            $mobil->update([
                'nama_mobil' => $request->nama_mobil,
                'url_foto_mobil' => $path,
                'plat_nomor' => $request->plat_nomor,
                'ketersediaan' => $request->ketersediaan,
            ]);

            $mobil->specification()->update([
                'jenis_transmisi' => $request->jenis_transmisi,
                'kapasitas' => $request->kapasitas,
                'kategori' => $request->kategori,
                'fasilitas' => json_encode($fasilitas),
            ]);

            $mobil->rentalPrice()->update([
                'harga_solo' => $request->harga_solo,
                'harga_solo_raya' => $request->harga_solo_raya,
                'harga_luar_kota' => $request->harga_luar_kota,
            ]);
        } else {
            $mobil->update($request->only('nama_mobil', 'plat_nomor', 'ketersediaan', 'deskripsi'));

            $mobil->specification()->update([
                'jenis_transmisi' => $request->jenis_transmisi,
                'kapasitas' => $request->kapasitas,
                'kategori' => $request->kategori,
                'fasilitas' => json_encode($fasilitas),
            ]);

            $mobil->rentalPrice()->update([
                'harga_solo' => $request->harga_solo,
                'harga_solo_raya' => $request->harga_solo_raya,
                'harga_luar_kota' => $request->harga_luar_kota,
            ]);
        }

        return redirect()->route('admin.mobil.index')->with('success', 'Mobil berhasil diperbarui.');
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
