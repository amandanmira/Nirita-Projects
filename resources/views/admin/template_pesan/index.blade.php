@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Template Pesan</h2>
    <a href="{{ route('admin.template_pesan.create') }}" class="btn btn-primary mb-3">Tambah Template</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jenis Template</th>
                <th>No Telepon Tujuan</th>
                <th>Isi Template</th>
                <th style="width: 185px">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($templates as $t)
            <tr>
                <td>{{ $t->jenis_template }}</td>
                <td>{{ $t->no_telp_tujuan }}</td>
                <td>{!! nl2br(e($t->isi)) !!}</td>
                <td>
                    <a href="{{ route('admin.template_pesan.show', $t) }}" class="btn btn-primary btn-sm">Show</a>
                    <a href="{{ route('admin.template_pesan.edit', $t) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.template_pesan.destroy', $t) }}" method="POST" style="display:inline-block;">
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
