@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit FAQ</h2>

    <form action="{{ route('admin.testimoni.update', $testimoni) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <br>
        <h3>Gambar Sebelumnya:</h3>

        <img src="{{ asset('storage/' . $testimoni->url_gambar) }}" width="300">
        <br><br>
        <div class="mb-3">
            <label for="url_gambar" class="form-label">Gambar</label>
            <input type="file" name="url_gambar" id="url_gambar" class="form-control">
            @error('url_gambar') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        
        <div class="mb-3">
            <label for="desk_testimoni" class="form-label">Deskripsi Testimoni</label>
            <textarea name="desk_testimoni" id="desk_testimoni" rows="4" class="form-control">{{ $testimoni->desk_testimoni }}</textarea>
            @error('desk_testimoni') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('admin.testimoni.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
