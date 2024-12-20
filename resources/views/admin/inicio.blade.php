@extends('plantillaAdmin')
@section('titulo', 'Panel Admin')
@section('contenido')


    <h1>
        Panel de administración</h1>
    <h3>@auth {{ Auth::user()->name }} @endauth
    </h3>

@endsection
