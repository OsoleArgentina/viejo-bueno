<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Novedad;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class NovedadesController extends Controller
{
    public function get_novedades(Request $request)
    {
        $novedades = Novedad::orderBy('orden', 'asc')->get();
        return $this->success_response('', $novedades);
    }

    public function create_novedad(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'subtitulo' => 'required|string',
            'orden' => 'required|string|max:2',
            'descripcion_corta' => 'nullable|string|max:500',
            'descripcion_larga' => 'nullable|string|max:1000',
            'path' => 'required|mimes:jpeg,png,jpg,svg|max:20480',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $imagen = $request->file('path');
        $image_name = time() . '.' . $imagen->extension();
        
        $novedad = Novedad::create([
            'titulo' => $request->titulo,     
            'subtitulo' => $request->subtitulo,     
            'orden' => $request->orden,     
            'descripcion_corta' => $request->descripcion_corta ?? null,     
            'descripcion_larga' => $request->descripcion_larga ?? null,     
            'path' => $image_name,     
        ]);
        
        $imagen->move('img', $image_name);

        return $this->success_response('Novedad creada correctamente.', $novedad);
    }

    public function edit_novedad(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'novedad_id' => 'required',
            'titulo' => 'required|string',
            'subtitulo' => 'required|string',
            'orden' => 'required|string|max:2',
            'descripcion_corta' => 'nullable|string|max:500',
            'descripcion_larga' => 'nullable|string|max:1000',
            'path' => 'sometimes|required|mimes:jpeg,png,jpg,svg|max:20480',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $novedad = Novedad::findOrFail($request->novedad_id);

        $image_name = null;
        if (!is_null($request->path)) {
            $image_path = public_path('img/' . $novedad->path);
            
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $imagen = $request->file('path');
    
            $image_name = time() . '.' . $imagen->extension();
        
            $imagen->move('img', $image_name);
        }

        $novedad->update([
            'titulo' => $request->titulo,     
            'subtitulo' => $request->subtitulo,     
            'orden' => $request->orden,     
            'descripcion_corta' => $request->descripcion_corta ?? null,     
            'descripcion_larga' => $request->descripcion_larga ?? null,     
            'path' => $image_name ?? $novedad->path,
        ]);

        return $this->success_response('Novedad actualizada correctamente.');
    }

    public function delete_novedad(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'novedad_id' => 'required',
        ]);
 
        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $novedad = Novedad::findOrFail($request->novedad_id);

        $image_path = public_path('img/' . $novedad->path);  
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        
        $novedad->delete();

        return $this->success_response('Novedad eliminada correctamente.');
    }
}
