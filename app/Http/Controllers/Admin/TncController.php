<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tnc;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class TncController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tncs = Tnc::all();
        return view('admin.snk.index', compact('tncs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.snk.create');
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
        return redirect()->route('admin.snk.index')->with('success', 'Standar dan ketentuan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $tnc = Tnc::findOrFail($id);

        return view('admin.snk.edit', compact('tnc'));
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
        return redirect()->route('admin.snk.index')->with('success', 'Standar dan ketentuan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $tnc = Tnc::findOrFail($id);

        $tnc->delete();
        return redirect()->route('admin.snk.index')->with('success', 'Standar dan ketentuan berhasil dihapus.');
    }
}
