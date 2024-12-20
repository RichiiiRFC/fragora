@extends('plantillaContent')
@section('titulo', 'Fragora')
@section('contenido')
    @include('partials.productos')
    @if (session('success'))
        <div class="alert alert-success alerta-superpuesta">
            {{ session('success') }}
        </div>
    @endif
@endsection
