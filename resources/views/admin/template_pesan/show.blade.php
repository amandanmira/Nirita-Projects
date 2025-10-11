@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Template Pesan</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $template->jenis_template }}</h5>
            <p class="card-text">{{ $template->isi }}</p>

            <hr>

            <p>
                <strong>Link WhatsApp:</strong><br>
                {{ $waLink }}
            </p>
            <a href="{{ $waLink }}" target="_blank" class="btn btn-success">
                Buka di WhatsApp
            </a>
            <a href="{{ route('admin.template_pesan.index') }}" class="btn btn-secondary mt-2">Kembali</a>
        </div>
    </div>
</div>
@endsection
