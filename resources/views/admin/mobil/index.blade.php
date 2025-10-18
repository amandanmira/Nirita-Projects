@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Mobil</h2>
        <a href="{{ route('admin.mobil.create') }}" class="btn btn-primary mb-3">Tambah Mobil</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Mobil</th>
                    <th>Plat Nomor</th>
                    <th>Deskripsi</th>
                    <th style="width: 185px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($cars as $c)
                    <tr>
                        <td><img src="{{ asset('storage/' . $c->url_foto_mobil) }}" width="300"></td>
                        <td>{{ $c->nama_mobil }}</td>
                        <td>{{ $c->plat_nomor }}</td>
                        <td>{!! nl2br(e($c->deskripsi)) !!}</td>
                        <td>
                            <a href="{{ route('admin.mobil.show', $c) }}" class="btn btn-primary btn-sm">Show</a>
                            <a href="{{ route('admin.mobil.edit', $c) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.mobil.destroy', $c) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus template ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection