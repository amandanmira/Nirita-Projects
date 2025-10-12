@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah FAQ Baru</h2>

    <form action="{{ route('admin.faq.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="pertanyaan" class="form-label">Pertanyaan</label>
            <textarea name="pertanyaan" id="pertanyaan" rows="4" class="form-control" required></textarea>
            @error('pertanyaan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        
        <div class="mb-3">
            <label for="jawaban" class="form-label">Jawaban</label>
            <textarea name="jawaban" id="jawaban" rows="4" class="form-control" required></textarea>
            @error('jawaban') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
