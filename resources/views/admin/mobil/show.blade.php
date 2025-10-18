@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detail Mobil</h1>
        <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Kembali</a>
        <br><br>
        <div class="row mb-3">
            <div class="col-4">
                <img src="{{ asset('storage/' . $mobil->url_foto_mobil) }}" width="100%">
            </div>

            <div class="col">
                <table class="table">
                    <tr>
                        <td style="width: 200px;"><strong>Nama Mobil</strong></td>
                        <td style="width: 25px;">:</td>
                        <td>{{ $mobil->nama_mobil }}</td>
                    </tr>

                    <tr>
                        <td><strong>Deskripsi</strong></td>
                        <td>:</td>
                        <td>{!! nl2br(e($mobil->deskripsi)) !!}</td>
                    </tr>

                    <tr>
                        <td><strong>Plat Nomor</strong></td>
                        <td>:</td>
                        <td>{{ $mobil->plat_nomor }}</td>
                    </tr>

                    <tr>
                        <td><strong>Jumlah Tersedia</strong></td>
                        <td>:</td>
                        <td>{{ $mobil->ketersediaan . ' Unit' }}</td>
                    </tr>

                    <tr>
                        <td><strong>Kapasitas Penumpang</strong></td>
                        <td>:</td>
                        <td>{{ $mobil->specification->kapasitas . ' Orang' }}</td>
                    </tr>

                    <tr>
                        <td><strong>Jenis BBM</strong></td>
                        <td>:</td>
                        <td>{{ $mobil->specification->jenis_bbm }}</td>
                    </tr>

                    <tr>
                        <td><strong>Jenis Transmisi</strong></td>
                        <td>:</td>
                        <td>{{ $mobil->specification->jenis_transmisi }}</td>
                    </tr>

                    <tr>
                        <td><strong>Harga Solo</strong></td>
                        <td>:</td>
                        <td>{{ 'Rp. ' . number_format($mobil->rentalPrice->harga_solo, 2, ',', '.') }}</td>
                    </tr>

                    <tr>
                        <td><strong>Harga Solo Raya</strong></td>
                        <td>:</td>
                        <td>{{ 'Rp. ' . number_format($mobil->rentalPrice->harga_solo_raya, 2, ',', '.') }}</td>
                    </tr>

                    <tr>
                        <td><strong>Harga Luar Kota</strong></td>
                        <td>:</td>
                        <td>{{ 'Rp. ' . number_format($mobil->rentalPrice->harga_luar_kota, 2, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection