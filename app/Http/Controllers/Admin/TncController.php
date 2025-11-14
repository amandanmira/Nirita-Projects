<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tnc;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Mews\Purifier\Facades\Purifier;

class TncController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tncs = Tnc::all();
        return Inertia::render('Admin/SnK/Index', [
            'tncs' => $tncs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/SnK/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        $deskripsi = Purifier::clean($request->deskripsi);

        Tnc::create([
            'judul' => $request->judul,
            'deskripsi' => $deskripsi,
        ]);
        return redirect()->route('admin.snk.index')->with('success', 'Syarat dan ketentuan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $tncs = Tnc::findOrFail($id);

        return Inertia::render('Admin/SnK/Edit', [
            'tncs' => $tncs,
            'errors' => session('errors') ? session('errors')->getBag('default')->toArray() : (object) [],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $tnc = Tnc::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        $deskripsi = Purifier::clean($request->deskripsi);

        $tnc->update([
            'judul' => $request->judul,
            'deskripsi' => $deskripsi,
        ]);
        return redirect()->route('admin.snk.index')->with('success', 'Syarat dan ketentuan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $tnc = Tnc::findOrFail($id);

        $tnc->delete();
        return redirect()->route('admin.snk.index')->with('success', 'Syarat dan ketentuan berhasil dihapus.');
    }
}
