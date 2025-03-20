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
        $productos = Producto::with(['subcategoria', 'imagenes', 'marca'])->orderBy('orden', 'asc')->get();
        return $this->success_response('', $productos);
    }

    public function get_productos_destacadas(Request $request)
    {
        $productos = Producto::where('destacado', true)->orderBy('orden', 'asc')->with(['imagenes', 'marca'])->get();

        return $this->success_response('', $productos);
    }

    public function get_productos_relacionados($id)
    {
        $producto = Producto::findOrFail($id);

        $productos_relacionados = Producto::where(function ($query) use ($producto) {
            $query->where('marca_id', $producto->marca_id)
                ->orWhere('subcategoria_id', $producto->subcategoria_id);
        })
        ->where('id', '!=', $producto->id) 
        ->with(['imagenes', 'marca'])
        ->take(3)  
        ->get();

        return $this->success_response('', $productos_relacionados);
    }


    public function create_producto(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'marca_id' => 'required',
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

        $ficha_tecnica_name = null;
        if(!is_null($request->ficha_tecnica)){
            $ficha_tecnica_name =  uniqid() . '.' . $request->ficha_tecnica->extension();
            $request->ficha_tecnica->move('fichas', $ficha_tecnica_name);
        }

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'marca_id' => $request->marca_id,
            'precio' => $request->precio,
            'orden' => $request->orden,
            'destacado' => $request->destacado,
            'ficha_tecnica' => $ficha_tecnica_name,
            'subcategoria_id' => $request->subcategoria_id,
        ]);

        foreach ($request->imagenes as $imagen) {
            $path_name = uniqid() . '.' . $imagen->extension();
    
            $imagen->move('img', $path_name);

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
            'marca_id' => 'required',
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
            'marca_id' => $request->marca_id,
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

        $pdf = public_path('fichas/' . $producto->ficha_tecnica);  
        if (File::exists($pdf)) {
            File::delete($pdf);
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
    
            $imagen->move('img', $path_name);

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
