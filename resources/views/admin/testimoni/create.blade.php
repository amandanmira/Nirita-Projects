@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Template Baru</h2>

    <form action="{{ route('admin.testimoni.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="url_gambar" class="form-label">Gambar</label>
            <input type="file" name="url_gambar" id="url_gambar" class="form-control" required>
            @error('url_gambar') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        
        <div class="mb-3">
            <label for="desk_testimoni" class="form-label">Deskripsi Testimoni</label>
            <textarea name="desk_testimoni" id="desk_testimoni" rows="4" class="form-control"></textarea>
            @error('desk_testimoni') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.testimoni.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
