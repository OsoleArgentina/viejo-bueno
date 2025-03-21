<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contacto;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactoMail;

class ContactoController extends Controller
{
    public function get_contacto(Request $request)
    {
        $contacto = Contacto::first();
        return $this->success_response('', $contacto);
    }

    public function set_contacto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contacto_id' => 'nullable',
            'google_maps_iframe' => 'required|string|max:1000',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'correo' => 'required|email|max:255',
            'whatsapp' => 'required|string',
            'instagram' => 'required|string',
            'facebook' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $contacto = Contacto::updateOrCreate(
            ['id' => $request->contacto_id ?? -1],
            [
                'google_maps_iframe' => $request->google_maps_iframe,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'correo' => $request->correo,
                'whatsapp' => $request->whatsapp,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
            ]
        );

        return $this->success_response('Contacto cargado correctamente.', $contacto);
    }

    public function enviar_informacion_contacto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:255',
            'empresa' => 'nullable|string|max:255',
            'mensaje' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $data = [
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'empresa' => $request->empresa,
            'mensaje' => $request->mensaje,
        ];

        $contacto = Contacto::first();

        Mail::to($contacto->correo ?? 'example@gmail.com')->queue(new ContactoMail($data));

        return $this->success_response('Información enviada correctamente.', $data);
    }
 
}
