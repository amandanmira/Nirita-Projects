@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Invoice</h2>
        <a href="{{ route('admin.invoice.create') }}" class="btn btn-primary mb-3">Tambah Template</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mobil Yang Disewa</th>
                    <th>Penyewa</th>
                    <th>Tanggal Sewa</th>
                    <th>Driver</th>
                    <th>Total Pembayaran</th>
                    <th style="width: 185px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($bills as $b)
                    <tr>
                        <td>{{ $b->car->nama_mobil }}</td>
                        <td>{{ $b->nama_penyewa }}</td>
                        <td>{{ $b->tanggal_sewa }}</td>
                        <td>{{ $b->driver }}</td>
                        <td>{{ 'Rp. ' . number_format($b->total_pembayaran, 2, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('admin.invoice.show', $b) }}" class="btn btn-primary btn-sm">Show</a>
                            <a href="{{ route('admin.invoice.edit', $b) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.invoice.destroy', $b) }}" method="POST" style="display:inline-block;">
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