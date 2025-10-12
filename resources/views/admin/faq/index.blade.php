@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar FAQ</h2>
    <a href="{{ route('admin.faq.create') }}" class="btn btn-primary mb-3">Tambah FAQ</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Pertanyaan</th>
                <th>Jawaban</th>
                <th style="width: 130px">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($faqs as $f)
            <tr>
                <td>{!! nl2br(e($f->pertanyaan)) !!}</td>
                <td>{!! nl2br(e($f->jawaban)) !!}</td>
                <td>
                    <a href="{{ route('admin.faq.edit', $f) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.faq.destroy', $f) }}" method="POST" style="display:inline-block;">
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
