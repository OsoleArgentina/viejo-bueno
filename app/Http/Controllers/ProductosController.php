<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\ProductosImagenes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductosController extends Controller
{
    
    public function get_producto_by_id($id)
    {
        $producto = Producto::with('imagenes')->findOrFail($id);

        return $this->success_response('', $producto);

    }

    public function get_productos(Request $request)
    {
        $productos = Producto::with(['subcategoria', 'imagenes'])->get();
        return $this->success_response('', $productos);
    }

    public function create_producto(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'marca' => 'required|string',
            'precio' => 'required|numeric',
            'orden' => 'required|string|max:2',
            'destacado' => 'nullable|boolean',
            'ficha_tecnica' => 'sometimes|required|mimes:pdf|max:20480',
            'subcategoria_id' => 'required',
            'imagenes' => 'required|array|min:1',
            'imagenes.*' => 'mimes:jpeg,png,jpg,svg|max:20480'
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'marca' => $request->marca,
            'precio' => $request->precio,
            'orden' => $request->orden,
            'destacado' => $request->destacado,
            'ficha_tecnica' => $request->ficha_tecnica ?? null,
            'subcategoria_id' => $request->subcategoria_id,
        ]);

        foreach ($request->imagenes as $imagen) {
            $path_name = uniqid() . '.' . $imagen->extension();
    
            $imagen->move(public_path('img'), $path_name);

            ProductosImagenes::create([
                'producto_id' => $producto->id,
                'path' => $path_name,  
            ]);
        }

        return $this->success_response('Producto creado correctamente.', $producto);
    }

    public function edit_producto(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'producto_id' => 'required',
            'nombre' => 'required|string',
            'marca' => 'required|string',
            'precio' => 'required|numeric',
            'orden' => 'required|string|max:2',
            'ficha_tecnica' => 'sometimes|required|mimes:pdf|max:20480',
            'subcategoria_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $producto = Producto::findOrFail($request->producto_id);

        $producto->update([
            'nombre' => $request->nombre,
            'marca' => $request->marca,
            'precio' => $request->precio,
            'orden' => $request->orden,
            'ficha_tecnica' => $request->ficha_tecnica ?? null,
            'subcategoria_id' => $request->subcategoria_id,
        ]);

        return $this->success_response('Producto actualizado correctamente.', $producto);
    }

    public function edit_producto_destacado(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'producto_id' => 'required',
            'destacado' => 'required|boolean',
        
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $producto = Producto::findOrFail($request->producto_id);

        $producto->update([
            'destacado' => $request->destacado,
        ]);

        return $this->success_response('Producto actualizado correctamente.', $producto);
    }


    public function delete_producto(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'producto_id' => 'required',
        ]);
 
        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $producto = Producto::findOrFail($request->producto_id);

        foreach ($producto->imagenes as $imagen) {
            $imagen = public_path('img/' . $imagen->path);  
            if (File::exists($imagen)) {
                File::delete($imagen);
            }
        }
        
        $producto->delete();

        return $this->success_response('Producto eliminado correctamente.');
    }

    public function add_imagenes_producto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'producto_id' => 'required',
            'imagenes' => 'required|array|min:1',
            'imagenes.*' => 'mimes:jpeg,png,jpg,svg|max:20480'
        ]);
 
        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $producto = Producto::findOrFail($request->producto_id);

        foreach ($request->imagenes as $imagen) {
            $path_name = uniqid() . '.' . $imagen->extension();
    
            $imagen->move(public_path('img'), $path_name);

            ProductosImagenes::create([
                'producto_id' => $producto->id,
                'path' => $path_name,  
            ]);
        }

        return $this->success_response('Imagenes agregada/s correctamente.');
    }

    public function delete_imagen_producto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'producto_id' => 'required',
            'path' => 'required|string',
        ]);
 
        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $imagen = ProductosImagenes::where('producto_id', $request->producto_id)->where('path', $request->path)->first();

        $image_path = public_path('img/' . $imagen->path);  
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        
        $imagen->delete();

        return $this->success_response('Imagen del producto eliminada correctamente.');
    }


 
}
