<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoriasController extends Controller
{
    // NOSOTROS
    public function get_categorias(Request $request)
    {
        $categorias = Categoria::orderBy('orden', 'asc')->with('subcategorias.productos.imagenes', 'subcategorias.productos.marca')->get();
        return $this->success_response('', $categorias);
    }

    public function get_categorias_destacadas(Request $request)
    {
        $categorias = Categoria::where('destacado', true)->orderBy('orden', 'asc')->get();

        return $this->success_response('', $categorias);
    }

    public function create_categoria(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'orden' => 'required|string|max:2',
            'destacado' => 'nullable|boolean',
            'path' => 'required|mimes:jpeg,png,jpg,svg|max:20480',
            'icono' => 'sometimes|required|mimes:jpeg,png,jpg,svg|max:20480',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $path_imagen = $request->file('path');
        $path_name = uniqid() . '.' . $path_imagen->extension();
        
        
        $icono_imagen = $request->file('icono');
        $icono_name = null;

        if (!is_null($request->icono)) {
            $icono_name = uniqid() . '.' . $icono_imagen->extension();
        }
        
        $categoria = Categoria::create([
            'nombre' => $request->nombre,
            'orden' => $request->orden,
            'destacado' => $request->destacado,
            'path' => $path_name,
            'icono' => $icono_name,
        ]);
        
        $path_imagen->move(public_path('img'), $path_name);

        if (!is_null($request->icono)) {
            $icono_imagen->move(public_path('img'), $icono_name);
        }

        return $this->success_response('Categoria creada correctamente.', $categoria);
    }

    public function edit_categoria_destacado(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'categoria_id' => 'required',
            'destacado' => 'required|boolean',
        
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $categoria = Categoria::findOrFail($request->categoria_id);

        $categoria->update([
            'destacado' => $request->destacado,
        ]);

        return $this->success_response('Categoria actualizada correctamente.', $categoria);
    }

    public function edit_categoria(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'categoria_id' => 'required',
            'nombre' => 'required|string',
            'orden' => 'required|string|max:2',
            'path' => 'sometimes|required|mimes:jpeg,png,jpg,svg|max:20480',
            'icono' => 'sometimes|required|mimes:jpeg,png,jpg,svg|max:20480',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $categoria = Categoria::findOrFail($request->categoria_id);
        $categoria_path = $categoria->path; 
        $categoria_icono = $categoria->icono; 

        $path_name = null;
        if (!is_null($request->path)) {
            if($categoria_path){
                $image_path = public_path('img/' . $categoria_path);
                
                if (file_exists($image_path)) {
                    unlink($image_path);  
                }
            }

            $imagen = $request->file('path');
    
            $path_name = uniqid() . '.' . $imagen->extension();
        
            $imagen->move(public_path('img'), $path_name);
        }
        
        
        $icono_name = null;
        if (!is_null($request->icono)) {
            if($categoria_icono){
                $image_path = public_path('img/' . $categoria_icono);
                
                if (file_exists($image_path)) {
                    unlink($image_path);  
                }
            }

            $imagen = $request->file('icono');
    
            $icono_name = uniqid() . '.' . $imagen->extension();
        
            $imagen->move(public_path('img'), $icono_name);
        }

        $categoria->update([
            'nombre' => $request->nombre,
            'orden' => $request->orden,
            'path' => $path_name ?? $categoria->path,
            'icono' => $icono_name ?? $categoria->icono,
        ]);

        return $this->success_response('Categoria actualizada correctamente.');
    }

    public function delete_categoria(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'categoria_id' => 'required',
        ]);
 
        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $categoria = Categoria::findOrFail($request->categoria_id);

        $image_path = public_path('img/' . $categoria->path);  
        $image_icono = public_path('img/' . $categoria->icono);  
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        if (File::exists($image_icono)) {
            File::delete($image_icono);
        }
        
        $categoria->delete();

        return $this->success_response('Categoria eliminada correctamente.');
    }
 
}
