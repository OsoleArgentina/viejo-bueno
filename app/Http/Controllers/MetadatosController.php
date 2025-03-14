<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Metadato;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class MetadatosController extends Controller
{
    public function get_metadatos(Request $request)
    {
        $metadatos = Metadato::all();
        return $this->success_response('', $metadatos);
    }

    public function edit_metadato(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'metadato_id' => 'required',
            'keyword' => 'required|string',
            'descripcion' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $metadato = Metadato::findOrFail($request->metadato_id);

        $metadato->update([
            'keyword' => $request->keyword,
            'descripcion' => $request->descripcion,
        ]);

        return $this->success_response('Metadado actualizado correctamente.', $metadato);
    }
}
