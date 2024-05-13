@extends('layouts.plantilla')

@section('titulo', 'Crear Entradas')

@section('contenido')
    <div class="container">
        <div class="contenedor-edicion">
            <h1>Nueva Entrada</h1>
            <div class="formulario-edicion">
                <form method="POST" action="{{ route('entradas.guardar') }}" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}">
                        @error('titulo')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="contenido">Contenido:</label>
                        <textarea id="contenido" name="contenido">{{ old('contenido') }}</textarea>
                        @error('contenido')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="categoria">Categoría:</label>
                        <select id="categoria" name="categoria_id">
                            <option value="">Seleccione una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="imagen">Imagen:</label>
                        <input type="file" id="imagen" name="imagen">
                        @error('imagen')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <input type="hidden" name="usuario_id" value="{{ session('user_id') }}">
                        <div>
                    <div>
                        <button type="submit">Guardar</button>
                        <a href="{{ route('entradas.listar') }}" class="boton boton-volver">Volver</a>
                    </div>
                </form>             
            </div>
        </div>
    </div>
@endsection
