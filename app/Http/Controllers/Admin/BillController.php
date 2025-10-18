<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bill;
use App\Models\Car;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use mikehaertl\pdftk\Pdf;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::all();
        $cars = Car::all();
        return view('admin.invoice.index', compact('bills', 'cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::all();
        return view('admin.invoice.create', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_mobil' => 'required|exists:cars,id_mobil',
            'nama_penyewa' => 'required|string|max:50',
            'no_hp_penyewa' => 'required|string|max:40',
            'tanggal_sewa' => 'required|date',
            'driver' => 'nullable|string|max:50',
            'deskripsi_kegiatan' => 'nullable|string',
            'total_pembayaran' => 'required|numeric|min:0',
        ]);

        Bill::create($request->only('id_mobil', 'nama_penyewa', 'no_hp_penyewa', 'tanggal_sewa', 'driver', 'deskripsi_kegiatan', 'total_pembayaran'));
        return redirect()->route('admin.invoice.index')->with('success', 'Invoice berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $bill = Bill::findOrFail($id);

        return view('admin.invoice.show', compact('bill'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $bill = Bill::findOrFail($id);
        $cars = Car::all();

        return view('admin.invoice.edit', compact('bill', 'cars'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $bill = Bill::findOrFail($id);

        $request->validate([
            'id_mobil' => 'required|exists:cars,id_mobil',
            'nama_penyewa' => 'required|string|max:50',
            'no_hp_penyewa' => 'required|string|max:40',
            'tanggal_sewa' => 'required|date',
            'driver' => 'nullable|string|max:50',
            'deskripsi_kegiatan' => 'nullable|string',
            'total_pembayaran' => 'required|numeric|min:0',
        ]);

        $bill->update($request->only('id_mobil', 'nama_penyewa', 'no_hp_penyewa', 'tanggal_sewa', 'driver', 'deskripsi_kegiatan', 'total_pembayaran'));
        return redirect()->route('admin.invoice.index')->with('success', 'Invoice berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $bill = Bill::findOrFail($id);

        $bill->delete();
        return redirect()->route('admin.invoice.index')->with('success', 'Invoice berhasil dihapus.');
    }

    public function fillPdf(int $id)
    {
        // Sesuaikan dengan lokasi install PDFtk
        $pdftkPath = "C:\Program Files (x86)\PDFtk\bin\pdftk.exe";

        if (!file_exists($pdftkPath)) {
            return '<h1>Software PDFtk Tidak Ditemukan !</h1>
            <p>Silahkan install <a href="https://www.pdflabs.com/tools/pdftk-the-pdf-toolkit/">PDFtk</a> terlebih dahulu</p>';
        }

        $bill = Bill::findOrFail($id);
        $data = [
            'penyewa' => $bill->nama_penyewa,
            'mobil' => $bill->car->nama_mobil,
            'tgl_sewa' => $bill->tanggal_sewa,
            'ket_pelayanan' => $bill->deskripsi_kegiatan,
            'ket_rute' => $bill->deskripsi_kegiatan,
            'harga' => $bill->total_pembayaran,
            'total_harga' => $bill->total_pembayaran,
            'terbilang' => $bill->total_pembayaran,
            'driver' => $bill->driver,
            'tgl' => now(),
        ];

        $pdfTemplate = storage_path('app/public/template_invoice.pdf');
        $outputPdf = storage_path('app/public/invoice.pdf');

        $pdf = new Pdf($pdfTemplate, [
            'command' => "C:\Program Files (x86)\PDFtk\bin\pdftk.exe",
            'useExec' => true,
        ]);
        $result = $pdf->fillForm($data)
            ->needAppearances()
            ->flatten()
            ->saveAs($outputPdf);

        if ($result === false) {
            return response()->json([
                'error' => $pdf->getError()
            ], 500);
        }

        return response()->file($outputPdf);
    }
}
