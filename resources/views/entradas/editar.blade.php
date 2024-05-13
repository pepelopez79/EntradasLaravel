@extends('layouts.plantilla')

@section('titulo', 'Editar Entrada')

@section('contenido')
    <div class="container">
        <div class="contenedor-edicion">
            <h1>Editar Entrada</h1>
            <div class="formulario-edicion">
                <form method="POST" action="{{ route('entradas.actualizar', $entrada->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="titulo">Título:</label>
                        <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $entrada->titulo) }}">
                        @error('titulo')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="contenido">Contenido:</label>
                        <textarea id="contenido" name="contenido">{{ old('contenido', $entrada->contenido) }}</textarea>
                        @error('contenido')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="categoria">Categoría:</label>
                        <select id="categoria" name="categoria_id">
                            <option value="">Seleccione una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id', $entrada->categoria_id) == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
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
                        <button type="submit"">Guardar Cambios</button>
                        <a href="{{ route('entradas.listar') }}" class="boton boton-volver">Volver</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#contenido'))
            .catch(error => {
                console.error(error);
            });
    </script>    
@endsection
