<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Marca;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MarcasController extends Controller
{
    public function get_marcas(Request $request)
    {
        $marcas = Marca::orderBy('orden', 'asc')->with('categoria')->get();
        return $this->success_response('', $marcas);
    }

    public function get_marcas_destacadas(Request $request)
    {
        $marcas = Marca::where('destacado', true)->get();

        return $this->success_response('', $marcas);
    }

    public function create_marca(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'orden' => 'required|string|max:2',
            'destacado' => 'nullable|boolean',
            'categoria_id' => 'required',
            'path' => 'required|image|mimes:jpeg,png,jpg,svg|max:20480',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $imagen = $request->file('path');
        $path_name = uniqid() . '.' . $imagen->extension();
        $imagen->move(public_path('img'), $path_name);

        $marca = Marca::create(
            [
                'nombre' => $request->nombre,     
                'orden' => $request->orden,    
                'destacado' => $request->destacado,
                'categoria_id' => $request->categoria_id,     
                'path' => $path_name,     
            ]
        );

        return $this->success_response('Marca creada correctamente.', $marca);
    }
    
    public function edit_marca_destacado(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'marca_id' => 'required',
            'destacado' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $marca = Marca::findOrFail($request->marca_id);

        $marca->update([
            'destacado' => $request->destacado,
        ]);

        return $this->success_response('Marca actualizada correctamente.', $marca);
    }

    public function edit_marca(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'marca_id' => 'required',
            'nombre' => 'required|string',
            'orden' => 'required|string|max:2',
            'categoria_id' => 'required',
            'path' => 'sometimes|required|image|mimes:jpeg,png,jpg,svg|max:20480',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $marca = Marca::findOrFail($request->marca_id);

        $imagen_marca = $marca->path;
        $image_name = null;
        if (!is_null($request->path)) {
            $image_path = public_path('img/' . $marca->path);
            
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $imagen = $request->file('path');
    
            $image_name = time() . '.' . $imagen->extension();
        
            $imagen->move(public_path('img'), $image_name);
        }

        $marca->update([
            'nombre' => $request->nombre,
            'orden' => $request->orden,
            'categoria_id' => $request->categoria_id,
            'path' => $image_name ?? $marca->path,
        ]);

        return $this->success_response('Marca actualizada correctamente.');
    }

    public function delete_marca(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'marca_id' => 'required',
        ]);
 
        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $marca = Marca::findOrFail($request->marca_id);

        $image_path = public_path('img/' . $marca->path);  
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        
        $marca->delete();

        return $this->success_response('Marca eliminada correctamente.');
    }
 
}
