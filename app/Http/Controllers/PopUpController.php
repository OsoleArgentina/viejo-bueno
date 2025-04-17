<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Popup;
use Illuminate\Support\Facades\Validator;

class PopUpController extends Controller
{
    public function get_popup(Request $request)
    {
        $popup = Popup::first();
        return $this->success_response('', $popup);
    }

    public function set_popup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'popup_id' => 'nullable',
            'titulo' => 'required|string|max:150',
            'descripcion' => 'nullable|string|max:500',
            'desc_boton' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $popup = Popup::updateOrCreate(
            ['id' => $request->popup_id ?? -1],
            [
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'desc_boton' => $request->desc_boton,
            ]
        );

        return $this->success_response('Pop-up cargado correctamente.', $popup);
    }
}

