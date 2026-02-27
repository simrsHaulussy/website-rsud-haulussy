@extends('visitor.layout.main')

@section('title', 'Struktur Organisasi')

@section('content')
    <div class="text-center mb-5">
        <h1>Struktur Organisasi</h1>
    </div>
    <div class="container">
        <img src="{{ asset('visitor/assets/img/diagram/Diagram Struktur Organisasi 2026.png') }}" alt=""
            width="100%" height="100%">
        <p class="text-danger">
            <b>*Diperbarui 20 Februari 2026</b>
        </p>
    </div>
@endsection
