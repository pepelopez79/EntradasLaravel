@extends('layouts.plantilla')

@section('titulo', 'Detalle de Entrada')

@section('contenido')
    <div class="container">
        <div class="entrada">
            <div class="contenido-entrada">
                <h2 class="subtitulo-entrada">{{ $entrada->titulo }}</h2>
                <p class="texto-entrada">{{ $entrada->contenido }}</p>
                <p class="info-entrada"><strong>Creador:</strong> {{ $entrada->usuario->name }}</p>
                <p class="info-entrada"><strong>Categoría:</strong> {{ $entrada->categoria->nombre }}</p>
                <p class="info-entrada"><strong>Fecha de Creación:</strong> {{ $entrada->created_at }}</p>
                <a href="{{ route('entradas.listar') }}" class="boton boton-volver" style="float: right; margin-top: 140px; margin-right: 30px; width: 100px;">Volver</a>
            </div>
            <div class="imagen-entrada">
                <img src="{{ asset('images/' . $entrada->imagen) }}" alt="Imagen de la entrada" class="imagen">
            </div>
        </div>
    </div>
@endsection
