<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Subcategoria;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SubcategoriasController extends Controller
{
    // NOSOTROS
    public function get_subcategorias(Request $request)
    {
        $subcategorias = Subcategoria::with('categoria')->get();
        return $this->success_response('', $subcategorias);
    }

    public function create_subcategoria(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'categoria_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }
        
        $subcategoria = Subcategoria::create([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id,
        ]);
    

        return $this->success_response('Subcategoria creada correctamente.', $subcategoria);
    }

    public function edit_subcategoria(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'subcategoria_id' => 'required',
            'nombre' => 'required|string',
            'categoria_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $subcategoria = Subcategoria::findOrFail($request->subcategoria_id);
  
        $subcategoria->update([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id,
        ]);

        return $this->success_response('Subcategoria actualizada correctamente.');
    }

    public function delete_subcategoria(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'subcategoria_id' => 'required',
        ]);
 
        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $subcategoria = Subcategoria::findOrFail($request->subcategoria_id);

        $subcategoria->delete();

        return $this->success_response('Subcategoria eliminada correctamente.');
    }
}
