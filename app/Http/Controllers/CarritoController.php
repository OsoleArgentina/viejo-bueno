<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\PedidoMail;
use App\Models\Contacto;

class CarritoController extends Controller
{
    public function create_pedido(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'direccion_detalle' => 'required|string|max:255',
            'localidad' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'correo' => 'required|string|max:255',
            'informacion_adicional' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $data = [
            'nombre' => $request->nombre,
            'pais' => $request->pais,
            'direccion' => $request->direccion,
            'direccion_detalle' => $request->direccion_detalle,
            'localidad' => $request->localidad,
            'codigo_postal' => $request->codigo_postal,
            'telefono' => $request->telefono,
            'correo' => $request->correo,
            'informacion_adicional' => $request->informacion_adicional,
        ];

        $contacto = Contacto::first();

        Mail::to($contacto->correo ?? 'example@gmail.com')->queue(new PedidoMail($data, $request->pedido));

        return $this->success_response('Pedido enviado correctamente.');
    }
}
