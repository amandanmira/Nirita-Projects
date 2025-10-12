@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Testimoni</h2>
    <a href="{{ route('admin.testimoni.create') }}" class="btn btn-primary mb-3">Tambah FAQ</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th style="width: 130px">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($testimonials as $t)
            <tr>
                <td><img src="{{ asset('storage/' . $t->url_gambar) }}" width="300"></td>
                <td>{!! nl2br(e($t->desk_testimoni)) !!}</td>
                <td>
                    <a href="{{ route('admin.testimoni.edit', $t) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.testimoni.destroy', $t) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus template ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
