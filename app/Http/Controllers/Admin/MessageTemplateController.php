<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessageTemplate;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MessageTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = MessageTemplate::all();
        return Inertia::render('Admin/TemplatePesan/Index', [
            'templates' => $templates,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/TemplatePesan/Create');
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
        return redirect()->route('admin.template-pesan.index')->with('success', 'Template berhasil ditambahkan.');
    }

    public function show(int $id)
    {
        $template = MessageTemplate::findOrFail($id);
        $pesan = $template->isi;
        $nomor = preg_replace('/[^0-9]/', '', $template->no_telp_tujuan);
        $pesanEncoded = urlencode($pesan);
        $waLink = "https://wa.me/{$nomor}?text={$pesanEncoded}";

        return Inertia::render('Admin/TemplatePesan/Show', [
            'template' => $template,
            'waLink' => $waLink,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $template = MessageTemplate::findOrFail($id);

        return Inertia::render('Admin/TemplatePesan/Edit', [
            'templates' => $template,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $template = MessageTemplate::findOrFail($id);

        $request->validate([
            'jenis_template' => 'required|unique:message_templates,jenis_template,' . $template->id_template . ',id_template',
            'no_telp_tujuan' => 'required',
            'isi' => 'required',
        ]);

        $template->update($request->only('jenis_template', 'no_telp_tujuan', 'isi'));
        return redirect()->route('admin.template-pesan.index')->with('success', 'Template berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $template = MessageTemplate::findOrFail($id);

        $template->delete();
        return redirect()->route('admin.template-pesan.index')->with('success', 'Template berhasil dihapus.');
    }
}
