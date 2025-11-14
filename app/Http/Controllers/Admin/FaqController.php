<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Mews\Purifier\Facades\Purifier;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::all();
        return Inertia::render('Admin/FAQ/Index', [
            'faqs' => $faqs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/FAQ/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);

        $jawaban = Purifier::clean($request->jawaban);

        Faq::create([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $jawaban,
        ]);
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);

        return Inertia::render('Admin/FAQ/Edit', [
            'faq' => $faq,
            'errors' => session('errors') ? session('errors')->getBag('default')->toArray() : (object) [],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // \Log::info('Update request masuk untuk ID FAQ: ' . $id);
        // \Log::info('Isi data request:', $request->all());
        $faq = Faq::findOrFail($id);

        // Allow partial updates: only validate fields that are present in the request
        $request->validate([
            'pertanyaan' => 'sometimes|required',
            'jawaban' => 'sometimes|required',
        ]);

        $data = [];
        // Use has() so fields that are present (even empty) are considered for update.
        if ($request->has('pertanyaan')) {
            $data['pertanyaan'] = $request->pertanyaan;
        }

        if ($request->has('jawaban')) {
            // sanitize when jawaban provided
            $data['jawaban'] = Purifier::clean($request->jawaban);
        }

        // If no fields provided, nothing to update
        if (!empty($data)) {
            $faq->update($data);
        }

        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);

        $faq->delete();
        return redirect()->route('admin.faq.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
