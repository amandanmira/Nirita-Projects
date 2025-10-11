@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Halaman Management Admin :</h2>

    <div class="list-group">
        <a href="{{ route('admin.template_pesan.index') }}" class="link-underline link-underline-opacity-0"><button type="button" class="list-group-item list-group-item-action">Manage Template Pesan</button></a>
        <a href="{{ route('admin.faq.index') }}" class="link-underline link-underline-opacity-0"><button type="button" class="list-group-item list-group-item-action">Manage FAQ</button></a>
    </div>
</div>
@endsection