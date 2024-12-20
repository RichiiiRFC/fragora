@extends('plantillaMe')
@section('titulo', 'Mi Dirección')
@section('contenido')

    <h1>DIRECCIÓN</h1>
    <hr>
    <div class="row cliente-perfil">
        <div class="col-12 col-md-6">

            <form action="{{ route('direccion.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" class="form-control" name="direccion" id="direccion"
                        value="{{ old('direccion', auth()->user()->direccion->direccion) }}">
                    @error('direccion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" id="telefono"
                        value="{{ old('telefono', auth()->user()->direccion->telefono) }}">
                    @error('telefono')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ciudad">Ciudad:</label>
                    <input type="text" class="form-control" name="ciudad" id="ciudad"
                        value="{{ old('ciudad', auth()->user()->direccion->ciudad) }}">
                    @error('ciudad')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

        </div>

        <div class="col-12 col-md-6">
            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="text" class="form-control" name="provincia" id="provincia"
                    value="{{ old('provincia', auth()->user()->direccion->provincia) }}">
                @error('provincia')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="cod_postal">Código Postal:</label>
                <input type="text" class="form-control" name="cod_postal" id="cod_postal"
                    value="{{ old('cod_postal', auth()->user()->direccion->cod_postal) }}">
                @error('cod_postal')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="pais">País:</label>
                <input type="text" class="form-control" name="pais" id="pais"
                    value="{{ old('pais', auth()->user()->direccion->pais) }}">
                @error('pais')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary mt-2">Guardar</button>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alerta-superpuesta">
            {{ session('success') }}
        </div>
    @endif

@endsection
