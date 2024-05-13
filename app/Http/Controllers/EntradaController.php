<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Categoria;
use App\Models\User;

class EntradaController extends Controller
{
    public function listar(Request $request)
    {
        $query = $request->input('query');
        $orden = $request->input('orden', 'desc');
        
        $userId = session('user_id');
        $usuario = User::find($userId);

        if ($usuario && $usuario->rol === 'admin') {
            $entradas = Entrada::orderBy('created_at', $orden);
            if ($query) {
                $entradas->where('titulo', 'like', "%$query%");
            }
        } elseif ($usuario) {
            $entradas = Entrada::where('usuario_id', $userId)
                ->orderBy('created_at', $orden);
            if ($query) {
                $entradas->where('titulo', 'like', "%$query%");
            }
        } else {
            abort(404, 'Usuario no encontrado');
        }

        $entradas = $entradas->paginate(4);

        return view('entradas.listar', compact('entradas', 'query', 'orden'));
    } 

    public function mostrar($id)
    {
        $entrada = Entrada::find($id);

        if (!$entrada) {
            abort(404);
        }

        return view('entradas.mostrar', compact('entrada'));
    }   

    public function crear()
    {
        $categorias = Categoria::all();
        return view('entradas.crear', compact('categorias'));
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'contenido' => 'required',
            'categoria_id' => 'required',
        ], [
            'titulo.required' => 'El campo título es obligatorio.',
            'contenido.required' => 'El campo contenido es obligatorio.',
            'categoria_id.required' => 'Debes seleccionar una categoría.',
        ]);

        $entrada = new Entrada();
        
        $entrada->titulo = $request->input('titulo');
        $entrada->contenido = $request->input('contenido');
        $entrada->categoria_id = $request->input('categoria_id');
        $entrada->usuario_id = $request->input('usuario_id');

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombre_original = $imagen->getClientOriginalName();
            $extension = $imagen->getClientOriginalExtension();
            $nombre_imagen = time() . '_' . pathinfo($nombre_original, PATHINFO_FILENAME) . '.' . $extension;
            $imagen->move(public_path('images'), $nombre_imagen);
            $entrada->imagen = $nombre_imagen;
        }        
        
        $entrada->save();

        return redirect()->route('entradas.listar')->with('success', 'Entrada creada correctamente');
    }     

    public function editar($id)
    {
        $entrada = Entrada::findOrFail($id);
        $categorias = Categoria::all();
        return view('entradas.editar', compact('entrada', 'categorias'));
    }

    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required',
            'contenido' => 'required',
            'categoria_id' => 'required',
        ], [
            'titulo.required' => 'El campo título es obligatorio.',
            'contenido.required' => 'El campo contenido es obligatorio.',
            'categoria_id.required' => 'Debes seleccionar una categoría.',
        ]);

        $entrada = Entrada::findOrFail($id);
        
        $entrada->titulo = $request->input('titulo');
        $entrada->contenido = $request->input('contenido');
        $entrada->categoria_id = $request->input('categoria_id');

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombre_original = $imagen->getClientOriginalName();
            $extension = $imagen->getClientOriginalExtension();
            $nombre_imagen = time() . '_' . pathinfo($nombre_original, PATHINFO_FILENAME) . '.' . $extension;
            $imagen->move(public_path('images'), $nombre_imagen);
            $entrada->imagen = $nombre_imagen;
        } 
        
        $entrada->save();

        return redirect()->route('entradas.listar')->with('success', 'Entrada actualizada correctamente');
    }

    public function eliminar($id)
    {
        $entrada = Entrada::findOrFail($id);
        return view('entradas.eliminar', compact('entrada'));
    }

    public function borrar($id)
    {
        $entrada = Entrada::findOrFail($id);
        $entrada->delete();
        
        return redirect()->route('entradas.listar')->with('success', 'Entrada eliminada correctamente');
    }
}

