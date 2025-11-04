@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Standar Dan Ketentuan</h2>
        <a href="{{ route('admin.snk.create') }}" class="btn btn-primary mb-3">Tambah SnK</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th style="width: 130px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @php
                    use Mews\Purifier\Facades\Purifier;
                @endphp

                @foreach ($tncs as $t)
                    <tr>
                        <td>{!! nl2br(e($t->judul)) !!}</td>
                        <td>{!! Purifier::clean($t->deskripsi) !!}</td>
                        <td>
                            <a href="{{ route('admin.snk.edit', $t) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.snk.destroy', $t) }}" method="POST" style="display:inline-block;">
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