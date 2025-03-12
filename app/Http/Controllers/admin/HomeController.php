<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function get_sliders(Request $request)
    {
        $sliders = Slider::orderBy('orden', 'asc')->get();
        return $this->success_response('', $sliders);
    }

    public function set_slider(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'titulo' => 'nullable|string',
            'subtitulo' => 'nullable|string',
            'orden' => 'required|string|max:2',
            'path' => 'required|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov|max:20480',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $imagen = $request->file('path');
        $image_name = time() . '.' . $imagen->extension();
        
        $slider = Slider::create([
            'titulo' => $request->titulo ?? '',     
            'subtitulo' => $request->subtitulo ?? '',     
            'orden' => $request->orden,     
            'path' => $image_name,     
        ]);
        
        $imagen->move(public_path('img'), $image_name);

        return $this->success_response('Slider creado correctamente.', $slider);
    }

    public function edit_slider(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'slider_id' => 'required',
            'titulo' => 'nullable|string',
            'subtitulo' => 'nullable|string',
            'path' => 'sometimes|required|mimes:jpeg,png,jpg,gif,svg,mp4,avi,mov|max:20480',
            'orden' => 'required|string|max:2',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $slider = Slider::findOrFail($request->slider_id);

        $imagen_slider = $slider->imagen;
        $image_name = null;
        if (!is_null($request->path)) {
            if($imagen_slider){
                $image_path = public_path('img/' . $imagen_slider->name);
                
                if (file_exists($image_path)) {
                    unlink($image_path);  
                }
            }

            $imagen = $request->file('path');
    
            $image_name = time() . '.' . $imagen->extension();
        
            $imagen->move(public_path('img'), $image_name);
        }

        $slider->update([
            'titulo' => $request->titulo ?? '',
            'subtitulo' => $request->subtitulo ?? '',
            'orden' => $request->orden,
            'path' => $image_name ?? $slider->path,
        ]);

        return $this->success_response('Slider actualizado correctamente.');
    }

    public function delete_slider(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'slider_id' => 'required',
        ]);
 
        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $slider = Slider::findOrFail($request->slider_id);

        $image_path = public_path('img/' . $slider->path);  
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        
        $slider->delete();

        return $this->success_response('Slider eliminado correctamente.');
    }

    // public function delete_image(Request $request)
    // {   
    //     $validator = Validator::make($request->all(), [
    //         'image_id' => 'required',
    //     ]);
 
    //     if ($validator->fails()) {
    //         return $this->error_response($validator->messages()->first());
    //     }

    //     $image = Imagen::findOrFail($request->image_id);

    //     $image_path = public_path('img/' . $image->name);

    //     if (file_exists($image_path)) {
    //         unlink($image_path);  
    //     }
        
    //     $image->delete();

    //     return $this->success_response('Imagen eliminada correctamente.');
    // }
}
