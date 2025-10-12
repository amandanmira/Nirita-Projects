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
        $request->validate([
            'url_foto_mobil' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'nama_mobil' => 'required',
            'deskripsi' => 'nullable',
            'plat_nomor' => 'required',
            'ketersediaan' => 'required|numeric',
            // spesifikasi
            'kapasitas' => 'required|numeric',
            'jenis_bbm' => 'required',
            'jenis_transmisi' => 'required',
            // harga sewa
            'harga_solo' => 'required|numeric',
            'harga_solo_raya' => 'required|numeric',
            'harga_luar_kota' => 'required|numeric',
        ]);

        $image = $request->file('url_foto_mobil');
        $path = $image->storeAs('mobil', $image->hashName());

        $mobil = Car::create([
            'nama_mobil' => $request->nama_mobil,
            'url_foto_mobil' => $path,
            'plat_nomor' => $request->plat_nomor,
            'ketersediaan' => $request->ketersediaan,
            'deskripsi' => $request->deskripsi,
        ]);

        $mobil->specification()->create([
            'jenis_transmisi' => $request->jenis_transmisi,
            'kapasitas' => $request->kapasitas,
            'jenis_bbm' => $request->jenis_bbm,
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
    public function update(Request $request, string $id)
    {
        $mobil = Car::findOrFail($id);

        $request->validate([
            'url_foto_mobil' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'nama_mobil' => 'required',
            'deskripsi' => 'nullable',
            'plat_nomor' => 'required',
            'ketersediaan' => 'required|numeric',
            // spesifikasi
            'kapasitas' => 'required|numeric',
            'jenis_bbm' => 'required',
            'jenis_transmisi' => 'required',
            // harga sewa
            'harga_solo' => 'required|numeric',
            'harga_solo_raya' => 'required|numeric',
            'harga_luar_kota' => 'required|numeric',
        ]);

        if ($request->hasFile('url_foto_mobil')) {
            $imagePath = 'storage/mobil/' . basename($mobil->url_foto_mobil);

            if (file_exists($imagePath))
                unlink($imagePath);
            
            $image = $request->file('url_foto_mobil');
            $path = $image->storeAs('mobil', $image->hashName());

            $mobil->update([
                'nama_mobil' => $request->nama_mobil,
                'url_foto_mobil' => $path,
                'plat_nomor' => $request->plat_nomor,
                'ketersediaan' => $request->ketersediaan,
                'deskripsi' => $request->deskripsi,
            ]);

            $mobil->specification()->update([
                'jenis_transmisi' => $request->jenis_transmisi,
                'kapasitas' => $request->kapasitas,
                'jenis_bbm' => $request->jenis_bbm,
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
                'jenis_bbm' => $request->jenis_bbm,
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
        $imagePath = 'storage/mobil/' . basename($mobil->url_foto_mobil);

        if (file_exists($imagePath))
            unlink($imagePath);

        $mobil->specification()->delete();
        $mobil->rentalPrice()->delete();
        $mobil->delete();

        return redirect()->route('admin.mobil.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
