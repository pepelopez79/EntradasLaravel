@extends('layouts.plantilla')

@section('titulo', 'Eliminar Entrada')

@section('contenido')
    <div class="contenedor-eliminar">
        <h1>Eliminar Entrada</h1>
        <p>¿Estás seguro de que deseas eliminar la entrada "{{ $entrada->titulo }}"?</p>
        <form method="POST" action="{{ route('entradas.borrar', $entrada->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="boton" style="margin-right: 20px">Eliminar</button>
            <a href="{{ route('entradas.listar') }}" class="boton boton-cancelar">Cancelar</a>
        </form>        
    </div>
@endsection
