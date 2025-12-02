<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Car;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Carbon\Carbon;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::with('billDetails.cars')->get();
        return Inertia::render('Admin/Invoice/Index', [
            'bills' => $bills
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = Car::with('rentalPrice')->get();
        return Inertia::render('Admin/Invoice/Create', [
            'cars' => $cars
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_penyewa' => 'required|string|max:50',
            'no_hp_penyewa' => 'required|string|max:40',
            'driver' => 'required|string|max:50',
            'total_pembayaran' => 'required|numeric',
            'lokasi_invoice' => 'nullable|string',
            'tanggal_invoice' => 'nullable|date',
            'detail.*.id_mobil' => 'required|exists:cars,id_mobil',
            'detail.*.lokasi_sewa' => 'required',
            'detail.*.tanggal_sewa' => 'required|date',
            'detail.*.tanggal_akhir_sewa' => 'required|date',
        ]);

        $total = 0;

        DB::transaction(function () use ($request) {
            $bill = Bill::create($request->only([
                'nama_penyewa',
                'no_hp_penyewa',
                'driver',
                'total_pembayaran',
                'lokasi_invoice',
                'tanggal_invoice',
                'catatan',
                'perusahaan',
            ]));

            foreach ($request->detail as $d) {
                BillDetail::create([
                    'id_nota' => $bill->id_nota,
                    'id_mobil' => $d['id_mobil'],
                    'tanggal_sewa' => $d['tanggal_sewa'],
                    'tanggal_akhir_sewa' => $d['tanggal_akhir_sewa'],
                    'lokasi_sewa' => $d['lokasi_sewa'],
                    'deskripsi_kegiatan' => $d['deskripsi_kegiatan'] ?? null,
                    'tujuan' => $d['tujuan'] ?? null,
                ]);
            }
        });

        return redirect()->route('admin.invoice.index')->with('success', 'Invoice berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $bill = Bill::with('billDetails.cars.rentalPrice')->findOrFail($id);

        return Inertia::render('Admin/Invoice/Show', [
            'bill' => $bill,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $bill = Bill::with('billDetails.cars')->findOrFail($id);
        $cars = Car::with('rentalPrice')->get();

        return Inertia::render('Admin/Invoice/Edit', [
            'bill' => $bill,
            'cars' => $cars,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $bill = Bill::findOrFail($id);

        $request->validate([
            'nama_penyewa' => 'required|string|max:50',
            'no_hp_penyewa' => 'required|string|max:40',
            'driver' => 'required|string|max:50',
            'total_pembayaran' => 'required|numeric',
            'lokasi_invoice' => 'nullable|string',
            'tanggal_invoice' => 'nullable|date',
            'detail.*.id_mobil' => 'required|exists:cars,id_mobil',
            'detail.*.lokasi_sewa' => 'required',
            'detail.*.tanggal_sewa' => 'required|date',
            'detail.*.tanggal_akhir_sewa' => 'required|date',
        ]);

        $oldDetailIds = $bill->billDetails()->pluck('id')->toArray();
        $newDetailIds = collect($request->detail)->pluck('id')->filter()->toArray();
        $toDelete = array_diff($oldDetailIds, $newDetailIds);

        if (!empty($toDelete)) {
            $bill->billDetails()->whereIn('id', $toDelete)->delete();
        }

        foreach ($request->detail as $d) {
            if (!empty($d['id'])) {
                // Jika ada ID → update
                $detail = $bill->billDetails()->find($d['id']);
                if ($detail) {
                    $detail->update([
                        'id_mobil' => $d['id_mobil'],
                        'lokasi_sewa' => $d['lokasi_sewa'],
                        'tanggal_sewa' => $d['tanggal_sewa'],
                        'tanggal_akhir_sewa' => $d['tanggal_akhir_sewa'],
                        'deskripsi_kegiatan' => $d['deskripsi_kegiatan'],
                        'tujuan' => $d['tujuan'],
                    ]);
                }
            } else {
                // Jika tidak ada ID → buat baru
                $bill->billDetails()->create([
                    'id_mobil' => $d['id_mobil'],
                    'lokasi_sewa' => $d['lokasi_sewa'],
                    'tanggal_sewa' => $d['tanggal_sewa'],
                    'tanggal_akhir_sewa' => $d['tanggal_akhir_sewa'],
                    'deskripsi_kegiatan' => $d['deskripsi_kegiatan'],
                    'tujuan' => $d['tujuan'],
                ]);
            }
        }

        $bill->update($request->only([
            'nama_penyewa',
            'no_hp_penyewa',
            'driver',
            'total_pembayaran',
            'lokasi_invoice',
            'tanggal_invoice',
            'catatan',
            'perusahaan',
        ]));

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
        // Ambil data nota + relasi mobil (detail_notas)
        $bill = Bill::with('billDetails.cars.rentalPrice')->findOrFail($id);

        // Hitung total pembayaran (opsional, jika ingin dijumlah dari mobil)
        $total = 0;

        foreach ($bill->billDetails as $detail) {
            $harga = match ($detail->lokasi_sewa) {
                'solo' => $detail->cars->rentalPrice->harga_solo,
                'solo_raya' => $detail->cars->rentalPrice->harga_solo_raya,
                'luar_kota' => $detail->cars->rentalPrice->harga_luar_kota,
            };

            $total += $harga * self::hitungSelisihHari($detail->tanggal_sewa, $detail->tanggal_akhir_sewa);
        }

        // Render ke Blade
        $pdf = Pdf::loadView('admin.invoice.invoice', [
            'nama' => $bill->nama_penyewa,
            'items' => $bill->billDetails->map(function ($detail) {
                $harga = match ($detail->lokasi_sewa) {
                    'solo' => $detail->cars->rentalPrice->harga_solo,
                    'solo_raya' => $detail->cars->rentalPrice->harga_solo_raya,
                    'luar_kota' => $detail->cars->rentalPrice->harga_luar_kota,
                } * self::hitungSelisihHari($detail->tanggal_sewa, $detail->tanggal_akhir_sewa);

                return [
                    'nama' => $detail->cars->nama_mobil,
                    'periode' => self::formatTanggal($detail->tanggal_sewa),
                    'tujuan' => $detail->tujuan,
                    'kegiatan' => $detail->deskripsi_kegiatan,
                    'harga' => $harga,
                ];
            }),
            'total' => $total,
            'terbilang' => self::terbilang($total) . ' RUPIAH',
            'catatan' => $bill->catatan,
            'driver' => $bill->driver,
            'lokasi' => $bill->lokasi_invoice,
            'tanggal' => self::formatTanggal($bill->tanggal_invoice ?? now()),
            'penanggungJawab' => 'Hari Suryono',
            'perusahaan' => $bill->perusahaan,
        ]);

        return $pdf->stream("invoice_{$bill->id_nota}.pdf");
        // return $pdf->download("invoice_{$nota->id_nota}.pdf");
    }

    private function terbilang($angka)
    {
        $angka = abs($angka);
        $baca = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
        $hasil = "";

        if ($angka < 12) {
            $hasil = " " . $baca[$angka];
        } else if ($angka < 20) {
            $hasil = self::terbilang($angka - 10) . " Belas ";
        } else if ($angka < 100) {
            $hasil = self::terbilang(intval($angka / 10)) . " Puluh " . self::terbilang($angka % 10);
        } else if ($angka < 200) {
            $hasil = " Seratus" . self::terbilang($angka - 100);
        } else if ($angka < 1000) {
            $hasil = self::terbilang(intval($angka / 100)) . " Ratus " . self::terbilang($angka % 100);
        } else if ($angka < 2000) {
            $hasil = " Seribu" . self::terbilang($angka - 1000);
        } else if ($angka < 1000000) {
            $hasil = self::terbilang(intval($angka / 1000)) . " Ribu " . self::terbilang($angka % 1000);
        } else if ($angka < 1000000000) {
            $hasil = self::terbilang(intval($angka / 1000000)) . " Juta " . self::terbilang($angka % 1000000);
        } else if ($angka < 1000000000000) {
            $hasil = self::terbilang(intval($angka / 1000000000)) . " Milyar " . self::terbilang($angka % 1000000000);
        } else if ($angka < 1000000000000000) {
            $hasil = self::terbilang(intval($angka / 1000000000000)) . " Triliun " . self::terbilang($angka % 1000000000000);
        }

        return strtoupper(trim($hasil));
    }

    private function formatTanggal($tanggal)
    {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $tanggalObj = date_create($tanggal);
        if (!$tanggalObj)
            return $tanggal;

        $tgl = date_format($tanggalObj, 'd');
        $bln = (int) date_format($tanggalObj, 'm');
        $thn = date_format($tanggalObj, 'Y');

        $hasil = $tgl . ' ' . $bulan[$bln] . ' ' . $thn;

        return $hasil;
    }

    private function hitungSelisihHari($tglSewa, $tglAkhirSewa)
    {
        $start = Carbon::parse($tglSewa);
        $end = Carbon::parse($tglAkhirSewa);

        $days = $start->diffInDays($end);

        return $days + 1;
    }
}
