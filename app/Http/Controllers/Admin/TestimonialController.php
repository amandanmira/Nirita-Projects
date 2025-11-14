<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return Inertia::render('Admin/Testimoni/Index', [
            'testimonials' => $testimonials,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Testimoni/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'url_gambar' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'desk_testimoni' => 'nullable|string',
        ]);

        $image = $request->file('url_gambar');
        // store on the public disk so files are available under /storage via the storage:link
        $path = $image->store('testimoni', 'public');

        Testimonial::create([
            'url_gambar' => $path,
            'desk_testimoni' => $request->desk_testimoni,
        ]);
        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimoni)
    {
        // Laravel akan resolve Testimonial model via route-model binding
        return Inertia::render('Admin/Testimoni/Edit', [
            'testimoni' => $testimoni,
        ]);
    }

    // Recommended: gunakan model binding agar Laravel otomatis resolve model
    public function update(Request $request, Testimonial $testimoni)
    {
        // validasi
        $validated = $request->validate([
            'url_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'desk_testimoni' => 'nullable|string',
        ]);

        // handle file baru
        if ($request->hasFile('url_gambar')) {
            // hapus file lama (jika ada) dari storage disk 'public'
            if ($testimoni->url_gambar && Storage::disk('public')->exists($testimoni->url_gambar)) {
                Storage::disk('public')->delete($testimoni->url_gambar);
            }

            // simpan file baru di disk public (storage/app/public/testimoni/...)
            $path = $request->file('url_gambar')->store('testimoni', 'public');
            $validated['url_gambar'] = $path;
        }

        // update model
        $testimoni->update($validated);

        return redirect()->route('admin.testimoni.index'); // atau ->route('admin.testimoni.index')
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimoni)
    {
        // delete from public disk if exists
        if ($testimoni->url_gambar && Storage::disk('public')->exists($testimoni->url_gambar)) {
            Storage::disk('public')->delete($testimoni->url_gambar);
        }

        $testimoni->delete();
        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
