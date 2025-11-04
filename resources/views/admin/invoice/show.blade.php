@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Invoice</h1>
        <a href="{{ route('admin.invoice.index') }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('admin.invoice.print', $bill) }}" class="btn btn-primary">Cetak Invoice</a>
        <br><br>
        <div class="row mb-3">
            <div class="col">
                <table class="table">
                    <tr>
                        <td style="width: 200px;"><strong>Detail Sewa</strong></td>
                        <td style="width: 25px;">:</td>
                        <td>
                            @foreach ($bill->billDetails as $d)
                                @php
                                    $lokasi = match ($d->lokasi_sewa) {
                                        'solo' => 'Solo',
                                        'solo_raya' => 'Solo Raya',
                                        'luar_kota' => 'Luar Kota',
                                    };
                                    $hargaSewa = match ($d->lokasi_sewa) {
                                        'solo' => $d->cars->rentalPrice->harga_solo,
                                        'solo_raya' => $d->cars->rentalPrice->harga_solo_raya,
                                        'luar_kota' => $d->cars->rentalPrice->harga_luar_kota,
                                    };
                                @endphp

                                <img src="{{ asset('storage/' . json_decode($d->cars->url_foto_mobil)[0]) }}"
                                    style="height: 100px">
                                <ul>
                                    <li><strong>Mobil Yang Dipinjam : </strong>{{ $d->cars->nama_mobil }}</li>
                                    <li><strong>Lokasi Sewa : </strong>{{ $lokasi }}</li>
                                    <li><strong>Harga Sewa : </strong>{{ 'Rp. ' . number_format($hargaSewa, 2, ',', '.') }}</li>
                                    <li><strong>Tanggal Sewa : </strong>{{ $d->tanggal_sewa }}</li>
                                    <li><strong>Deskripsi : </strong>{{ $d->deskripsi_kegiatan }}</li>
                                </ul>
                                <hr>
                            @endforeach
                        </td>
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
                        <td><strong> Nama Driver</strong></td>
                        <td>:</td>
                        <td>{{ $bill->driver }}</td>
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