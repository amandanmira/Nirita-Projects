@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Mobil Baru</h2>

    <form action="{{ route('admin.mobil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="url_foto_mobil" class="form-label">Gambar</label>
            <input type="file" name="url_foto_mobil" id="url_foto_mobil" class="form-control" required>
            @error('url_foto_mobil') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="nama_mobil" class="form-label">Nama Mobil</label>
            <input type="text" name="nama_mobil" id="nama_mobil" class="form-control" required>
            @error('nama_mobil') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control" required></textarea>
            @error('deskripsi') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="row mb-3">
            <div class="col">
                <label for="plat_nomor" class="form-label">Plat Nomor</label>
                <input type="text" name="plat_nomor" id="plat_nomor" class="form-control" required>
                @error('plat_nomor') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col">
                <label for="ketersediaan" class="form-label">Jumlah Ketersediaan</label>
                <input type="number" name="ketersediaan" id="ketersediaan" class="form-control" required>
                @error('ketersediaan') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <h3>Spesifikasi Mobil</h3>
        
        <div class="row mb-3">
            <div class="col">
                <label for="kapasitas" class="form-label">Kapasitas Penumpang</label>
                <input type="number" name="kapasitas" id="kapasitas" class="form-control" required>
                @error('kapasitas') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col">
                <label for="jenis_bbm" class="form-label">Jenis BBM</label>
                <input type="text" name="jenis_bbm" id="jenis_bbm" class="form-control" required>
                @error('jenis_bbm') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            
            <div class="col">
                <label for="jenis_transmisi" class="form-label">Jenis Transmisi</label>
                <input type="text" name="jenis_transmisi" id="jenis_transmisi" class="form-control" required>
                @error('jenis_transmisi') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <h3>Harga Sewa</h3>
        
        <div class="row mb-3">
            <div class="col">
                <label for="harga_solo" class="form-label">Harga Solo</label>
                <input type="number" name="harga_solo" id="harga_solo" class="form-control" required>
                @error('harga_solo') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col">
                <label for="harga_solo_raya" class="form-label">Harga Solo Raya</label>
                <input type="number" name="harga_solo_raya" id="harga_solo_raya" class="form-control" required>
                @error('harga_solo_raya') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="col">
                <label for="harga_luar_kota" class="form-label">Harga Luar Kota</label>
                <input type="number" name="harga_luar_kota" id="harga_luar_kota" class="form-control" required>
                @error('harga_luar_kota') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.mobil.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
