<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contacto;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

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
            ]
        );

        return $this->success_response('Contacto cargado correctamente.', $contacto);
    }
 
}
