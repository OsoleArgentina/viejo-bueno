<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nosotros;
use App\Models\Elegirnos;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class NosotrosController extends Controller
{
    // NOSOTROS
    public function get_nosotros(Request $request)
    {
        $nosotros = Nosotros::first();
        return $this->success_response('', $nosotros);
    }

    public function set_nosotros(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string',
            'descripcion' => 'required|string',
            'banner_principal' => 'sometimes|required|image|mimes:jpeg,png,jpg,svg|max:20480',
            'banner_secundario' => 'sometimes|required|mimes:mp4,avi,mov,wmv|max:20480',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $nosotros = Nosotros::first();

        if (!$nosotros && is_null($request->banner_principal)) {
            return $this->error_response("El banner principal es obligatorio");
        }

        $banner_principal_imagen = $request->file('banner_principal');
        $banner_secundario_imagen = $request->file('banner_secundario');
        $banner_principal_name = null;
        $banner_secundario_name = null;

        if (!is_null($request->banner_principal)) {
            $banner_principal_name = uniqid() . '.' . $banner_principal_imagen->extension();
        }
        
        if (!is_null($request->banner_secundario)) {
            $banner_secundario_name = uniqid() . '.' . $banner_secundario_imagen->extension();
        }
        
        
        Nosotros::updateOrCreate(
            ['id' => $nosotros->id ?? -1],
            [
                'titulo' => $request->titulo,     
                'descripcion' => $request->descripcion,     
                'banner_principal' => $banner_principal_name ?? $nosotros->banner_principal,  
                'banner_secundario' => $banner_secundario_name ?? $nosotros->banner_secundario ?? null,
            ]
        );
        
        if (!is_null($request->banner_principal)) {
            $banner_principal_imagen->move(public_path('img'), $banner_principal_name);
        }
        if (!is_null($request->banner_secundario)) {
            $banner_secundario_imagen->move(public_path('img'), $banner_secundario_name);
        }

        return $this->success_response('Nosotros guardado correctamente.', $nosotros);
    }

    // NOSOTROS ELEGIRNOS
    public function get_nosotros_elegirnos(Request $request)
    {
        $elegirnos = Elegirnos::all();
        return $this->success_response('', $elegirnos);
    }


    public function create_elegirnos(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required|string',
            'orden' => 'required|string|max:2',
            'path' => 'required|mimes:jpeg,png,jpg,svg|max:20480',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $imagen = $request->file('path');
        $image_name = uniqid() . '.' . $imagen->extension();
        
        $elegirnos = Elegirnos::create([
            'descripcion' => $request->descripcion,     
            'orden' => $request->orden,     
            'path' => $image_name,     
        ]);
        
        $imagen->move(public_path('img'), $image_name);

        return $this->success_response('Tarjeta creada correctamente.', $elegirnos);
    }

    public function edit_elegirnos(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'elegirnos_id' => 'required',
            'descripcion' => 'required|string',
            'orden' => 'required|string|max:2',
            'path' => 'sometimes|required|mimes:jpeg,png,jpg,svg|max:20480',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $elegirnos = Elegirnos::findOrFail($request->elegirnos_id);

        $imagen_elegirnos = $elegirnos->imagen;
        $image_name = null;
        if (!is_null($request->path)) {
            if($imagen_elegirnos){
                $image_path = public_path('img/' . $imagen_elegirnos->name);
                
                if (file_exists($image_path)) {
                    unlink($image_path);  
                }
            }

            $imagen = $request->file('path');
    
            $image_name = uniqid() . '.' . $imagen->extension();
        
            $imagen->move(public_path('img'), $image_name);
        }

        $elegirnos->update([
            'descripcion' => $request->descripcion,
            'orden' => $request->orden,
            'path' => $image_name ?? $elegirnos->path,
        ]);

        return $this->success_response('Tarjeta actualizado correctamente.');
    }

    public function delete_elegirnos(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'elegirnos_id' => 'required',
        ]);
 
        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $elegirnos = Elegirnos::findOrFail($request->elegirnos_id);

        $image_path = public_path('img/' . $elegirnos->path);  
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        
        $elegirnos->delete();

        return $this->success_response('Tarjeta eliminado correctamente.');
    }
 
}
