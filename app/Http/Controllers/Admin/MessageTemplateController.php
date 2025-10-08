<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessageTemplate;
use Illuminate\Http\Request;

class MessageTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = MessageTemplate::all();
        return view('admin.template_pesan.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.template_pesan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_template' => 'required|unique:message_templates',
            'no_telp_tujuan' => 'required',
            'isi' => 'required',
        ]);

        MessageTemplate::create($request->only('jenis_template', 'no_telp_tujuan', 'isi'));
        return redirect()->route('template_pesan.index')->with('success', 'Template berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $template = MessageTemplate::findOrFail($id);

        return view('admin.template_pesan.edit', compact('template'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $template = MessageTemplate::findOrFail($id);

        $request->validate([
            'jenis_template' => 'required|unique:message_templates,jenis_template,'.$id,
            'no_telp_tujuan' => 'required',
            'isi' => 'required',
        ]);

        $template->update($request->only('jenis_template', 'no_telp_tujuan', 'isi'));
        return redirect()->route('template_pesan.index')->with('success', 'Template berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $template = MessageTemplate::findOrFail($id);

        $template->delete();
        return redirect()->route('template_pesan.index')->with('success', 'Template berhasil dihapus.');
    }
}
