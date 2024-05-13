@extends('layouts.plantilla')

@section('titulo', 'Listado de Entradas')

@section('contenido')
    <div class="botones">
        <a href="{{ url('entradas/crear') }}" class="boton boton-nuevo">Nuevo</a>
        <div class="buscador">
            <form action="{{ route('entradas.listar') }}" method="GET">
                <input type="text" name="query" placeholder="Buscar por título..." value="{{ $query }}" class="input-busqueda">
                <button type="submit" class="boton-buscar">Buscar</button>
            </form>
        </div>                    
        @if ($entradas->lastPage() > 1)
            <ul class="pagination">
                @if ($entradas->onFirstPage())
                @endif
                @for ($i = 1; $i <= $entradas->lastPage(); $i++)
                    <li class="page-item {{ $i == $entradas->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $entradas->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                @if ($entradas->hasMorePages())
                @endif
            </ul>
        @endif
        <a href="{{ route('entradas.pdf') }}" class="boton boton-imprimir">Imprimir</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Contenido</th>
                <th>Imagen</th>
                <th>Usuario</th>
                <th>Categoría</th>
                <th>
                    Fecha de Creación
                    @if ($orden == 'asc')
                        <a href="{{ route('entradas.listar', ['orden' => 'desc']) }}" class="sort-icon desc"></a>
                    @else
                        <a href="{{ route('entradas.listar', ['orden' => 'asc']) }}" class="sort-icon asc"></a>
                    @endif
                </th>                
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entradas as $entrada)
                <tr>
                    <td>{{ $entrada->titulo }}</td>
                    <td>{{ $entrada->contenido }}</td>
                    <td><img src="{{ asset('images/' . $entrada->imagen) }}" class="image"></td>
                    <td>{{ $entrada->usuario->name }}</td>
                    <td>{{ $entrada->categoria->nombre }}</td>
                    <td>{{ $entrada->created_at }}</td>
                    <td>
                        <div>
                            <a href="{{ url('entradas/mostrar/' . $entrada->id) }}">Detalle</a>
                        </div>
                        <div>
                            <a href="{{ url('entradas/editar/' . $entrada->id) }}">Editar</a>
                        </div>
                        <div>
                            <a href="{{ url('entradas/eliminar/' . $entrada->id) }}">Eliminar</a>
                        </div>
                    </td>                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
