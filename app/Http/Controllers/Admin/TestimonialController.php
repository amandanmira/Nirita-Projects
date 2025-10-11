<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimoni.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimoni.create');
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
        $path = $image->storeAs('testimoni', $image->hashName());

        Testimonial::create([
            'url_gambar' => $path,
            'desk_testimoni' => $request->desk_testimoni,
        ]);
        return redirect()->route('admin.testimoni.index')->with('success', 'Template berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $testimoni = Testimonial::findOrFail($id);

        return view('admin.testimoni.edit', compact('testimoni'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $testimoni = Testimonial::findOrFail($id);

        $request->validate([
            'url_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'desk_testimoni' => 'nullable|string',
        ]);

        if ($request->hasFile('url_gambar')) {
            $imagePath = 'storage/testimoni/' . basename($testimoni->url_gambar);

            if (file_exists($imagePath))
                unlink($imagePath);
            
            $image = $request->file('url_gambar');
            $path = $image->storeAs('testimoni', $image->hashName());

            $testimoni->update([
                'url_gambar' => $path,
                'desk_testimoni' => $request->desk_testimoni,
            ]);
        } else {
            $testimoni->update($request->only('desk_testimoni'));
        }

        return redirect()->route('admin.testimoni.index')->with('success', 'Template berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $testimoni = Testimonial::findOrFail($id);
        $imagePath = 'storage/testimoni/' . basename($testimoni->url_gambar);

        if (file_exists($imagePath))
            unlink($imagePath);

        $testimoni->delete();
        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
