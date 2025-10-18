@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Invoice</h1>
        <a href="{{ route('admin.invoice.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('admin.invoice.print', $bill) }}" class="btn btn-primary">Cetak Invoice</a>
        <br><br>
        <div class="row mb-3">
            <div class="col-4">
                <img src="{{ asset('storage/' . $bill->car->url_foto_mobil) }}" width="100%">
            </div>

            <div class="col">
                <table class="table">
                    <tr>
                        <td style="width: 200px;"><strong>Mobil Yang Disewa</strong></td>
                        <td style="width: 25px;">:</td>
                        <td>{{ $bill->car->nama_mobil }}</td>
                    </tr>

                    <tr>
                        <td><strong>Nama Penyewa</strong></td>
                        <td>:</td>
                        <td>{{ $bill->nama_penyewa }}</td>
                    </tr>

                    <tr>
                        <td><strong>No HP Penyewa</strong></td>
                        <td>:</td>
                        <td>{{ $bill->no_hp_penyewa }}</td>
                    </tr>

                    <tr>
                        <td><strong>Tanggal Sewa</strong></td>
                        <td>:</td>
                        <td>{{ $bill->tanggal_sewa }}</td>
                    </tr>

                    <tr>
                        <td><strong> Nama Driver</strong></td>
                        <td>:</td>
                        <td>{{ $bill->driver }}</td>
                    </tr>

                    <tr>
                        <td><strong>Deskripsi</strong></td>
                        <td>:</td>
                        <td>{!! nl2br(e($bill->deskripsi_kegiatan)) !!}</td>
                    </tr>

                    <tr>
                        <td><strong>Total Pembayaran</strong></td>
                        <td>:</td>
                        <td>{{ 'Rp. ' . number_format($bill->total_pembayaran, 2, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection