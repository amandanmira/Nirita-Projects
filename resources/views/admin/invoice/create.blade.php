@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tambah Invoice Baru</h2>

        <form action="{{ route('admin.invoice.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="id_mobil" class="form-label">Mobil Yang Disewa</label>
                <select name="id_mobil" id="id_mobil" class="form-select" required>
                    <option value="">-- Pilih Mobil --</option>
                    @foreach ($cars as $c)
                        <option value="{{ $c->id_mobil }}">{{ $c->nama_mobil }}</option>
                    @endforeach
                </select>
                @error('id_mobil') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
                <input type="text" name="nama_penyewa" id="nama_penyewa" class="form-control" required>
                @error('nama_penyewa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="no_hp_penyewa" class="form-label">No Telepon Penyewa</label>
                <input type="tel" name="no_hp_penyewa" id="no_hp_penyewa" class="form-control" required>
                @error('no_hp_penyewa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-control" required>
                @error('tanggal_sewa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="driver" class="form-label">Nama Driver</label>
                <input type="text" name="driver" id="driver" class="form-control" required>
                @error('driver') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi_kegiatan" class="form-label">Deskripsi Kegiatan</label>
                <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" rows="4" class="form-control"></textarea>
                @error('deskripsi_kegiatan') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="total_pembayaran" class="form-label">Total Pembayaran</label>
                <input type="text" name="total_pembayaran" id="total_pembayaran" class="form-control" required>
                @error('total_pembayaran') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('admin.invoice.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection