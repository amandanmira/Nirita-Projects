@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Template</h2>

    <form action="{{ route('admin.template_pesan.update', $template) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="jenis_template" class="form-label">Jenis Template</label>
            <input type="text" name="jenis_template" id="jenis_template" class="form-control" value="{{ $template->jenis_template }}" required>
            @error('jenis_template') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="no_telp_tujuan" class="form-label">No Telepon Tujuan</label>
            <input type="tel" name="no_telp_tujuan" id="no_telp_tujuan" class="form-control" value="{{ $template->no_telp_tujuan }}" required>
            @error('no_telp_tujuan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="isi" class="form-label">Isi Template</label>
            <textarea name="isi" id="isi" rows="4" class="form-control" required>{{ $template->isi }}</textarea>
            @error('isi') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('admin.template_pesan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
