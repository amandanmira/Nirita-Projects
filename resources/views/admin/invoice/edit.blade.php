@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Template</h2>

        <form action="{{ route('admin.invoice.update', $bill) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="id_mobil" class="form-label">Mobil Yang Disewa</label>
                <select name="id_mobil" id="id_mobil" class="form-select" required>
                    @foreach ($cars as $c)
                        <option value="{{ $c->id_mobil }}" {{ $bill->id_mobil == $c->id_mobil ? 'selected' : '' }}>
                            {{ $c->nama_mobil }}
                        </option>
                    @endforeach
                </select>
                @error('id_mobil') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="nama_penyewa" class="form-label">Nama Penyewa</label>
                <input type="text" name="nama_penyewa" id="nama_penyewa" class="form-control"
                    value="{{ $bill->nama_penyewa }}" required>
                @error('nama_penyewa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="no_hp_penyewa" class="form-label">No Telepon Penyewa</label>
                <input type="tel" name="no_hp_penyewa" id="no_hp_penyewa" class="form-control"
                    value="{{ $bill->no_hp_penyewa }}" required>
                @error('no_hp_penyewa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal_sewa" class="form-label">Tanggal Sewa</label>
                <input type="date" name="tanggal_sewa" id="tanggal_sewa" class="form-control"
                    value="{{ $bill->tanggal_sewa }}" required>
                @error('tanggal_sewa') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="driver" class="form-label">Nama Driver</label>
                <input type="text" name="driver" id="driver" class="form-control" value="{{ $bill->driver }}" required>
                @error('driver') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi_kegiatan" class="form-label">Deskripsi Kegiatan</label>
                <textarea name="deskripsi_kegiatan" id="deskripsi_kegiatan" rows="4"
                    class="form-control">{{ $bill->deskripsi_kegiatan }}</textarea>
                @error('deskripsi_kegiatan') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="total_pembayaran" class="form-label">Total Pembayaran</label>
                <input type="text" name="total_pembayaran" id="total_pembayaran" class="form-control"
                    value="{{ $bill->total_pembayaran }}" required>
                @error('total_pembayaran') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <button type="submit" class="btn btn-success">Perbarui</button>
            <a href="{{ route('admin.invoice.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection