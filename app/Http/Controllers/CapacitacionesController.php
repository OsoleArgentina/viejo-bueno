<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Capacitacion;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CapacitacionesController extends Controller
{
    public function get_capacitaciones(Request $request)
    {
        $capacitaciones = Capacitacion::orderBy('orden', 'asc')->get();
        return $this->success_response('', $capacitaciones);
    }

    public function create_capacitacion(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'orden' => 'required|string|max:2',
            'descripcion' => 'required|string|max:500',
            'youtube_iframe' => 'required_without:path|string|max:1000',
            'path' => 'required_without:youtube_iframe|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov|max:20480',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $image_name = null;
        if(!is_null($request->path))
        {
            $imagen = $request->file('path');
            $image_name = time() . '.' . $imagen->extension();
        }

        $youtube_iframe = null;
        if(!is_null($request->youtube_iframe))
        {
            $youtube_iframe = $request->youtube_iframe;
        }
        
        $capacitacion = Capacitacion::create([
            'titulo' => $request->titulo,     
            'orden' => $request->orden,     
            'descripcion' => $request->descripcion,     
            'youtube_iframe' => $youtube_iframe,     
            'path' => $image_name,     
        ]);
        
        if($image_name){
            $imagen->move('img', $image_name);
        }

        return $this->success_response('Capacitacion creada correctamente.', $capacitacion);
    }

    public function edit_capacitacion(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'capacitacion_id' => 'required',
            'titulo' => 'required|string',
            'orden' => 'required|string|max:2',
            'descripcion' => 'required|string|max:500',
            'youtube_iframe' => 'sometimes|required|string|max:1000',
            'path' => 'sometimes|required|mimes:jpeg,png,jpg,svg|max:20480',
        ]);

        if(!is_null($request->path) && !is_null($request->youtube_iframe)){
            return $this->error_response('No se pueden enviar youtube iframe e imagen juntos.');
        }

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $capacitacion = Capacitacion::findOrFail($request->capacitacion_id);

        if(is_null($request->path) && is_null($request->youtube_iframe))
        {
            $capacitacion->update([
                'titulo' => $request->titulo,     
                'orden' => $request->orden,     
                'descripcion' => $request->descripcion,      
                'youtube_iframe' => $capacitacion->youtube_iframe,      
                'path' => $capacitacion->path,
            ]);

            return $this->success_response('Capacitacion actualizada correctamente.');
        }

        $image_name = null;
        if (!is_null($request->path)) {
            $image_path = public_path('img/' . $capacitacion->path);
            
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $imagen = $request->file('path');
    
            $image_name = time() . '.' . $imagen->extension();
        
            $imagen->move('img', $image_name);
        }

        if($request->youtube_iframe && $capacitacion->path){
            $image_path = public_path('img/' . $capacitacion->path);
            
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $capacitacion->update([
                'titulo' => $request->titulo,     
                'orden' => $request->orden,     
                'descripcion' => $request->descripcion,      
                'youtube_iframe' => $request->youtube_iframe,      
                'path' => null,
            ]);
        
            return $this->success_response('Capacitacion actualizada correctamente.');
        }

        $capacitacion->update([
            'titulo' => $request->titulo,     
            'orden' => $request->orden,     
            'descripcion' => $request->descripcion,      
            'youtube_iframe' => $request->youtube_iframe,      
            'path' => $image_name ?? $capacitacion->path,
        ]);

        return $this->success_response('Capacitacion actualizada correctamente.');
    }

    public function delete_capacitacion(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'capacitacion_id' => 'required',
        ]);
 
        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $capacitacion = Capacitacion::findOrFail($request->capacitacion_id);

        $image_path = public_path('img/' . $capacitacion->path);  
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        
        $capacitacion->delete();

        return $this->success_response('Capacitacion eliminada correctamente.');
    }
}
