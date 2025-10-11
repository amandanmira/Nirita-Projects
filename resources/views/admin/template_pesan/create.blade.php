@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Template Baru</h2>

    <form action="{{ route('admin.template_pesan.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="jenis_template" class="form-label">Jenis Template</label>
            <input type="text" name="jenis_template" id="jenis_template" class="form-control" required>
            @error('jenis_template') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="no_telp_tujuan" class="form-label">No Telepon Tujuan</label>
            <input type="tel" name="no_telp_tujuan" id="no_telp_tujuan" class="form-control" required>
            @error('no_telp_tujuan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">Isi Template</label>
            <textarea name="isi" id="isi" rows="4" class="form-control" required></textarea>
            @error('isi') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.template_pesan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
