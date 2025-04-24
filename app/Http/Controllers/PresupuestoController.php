<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contacto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\PresupuestoMail;
use Illuminate\Support\Facades\Http;

class PresupuestoController extends Controller
{
    public function solicitar_presupuesto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'empresa' => 'required|string|max:255',
            'categoria_id' => 'required',
            'marca_id' => 'required',
            'aclaraciones' => 'nullable|string|max:500',
            'archivos' => 'nullable|array|min:1',
            'archivos.*' => 'mimes:jpeg,png,jpg,svg,pdf,xlsx,xls|max:20480',
            'g-recaptcha-response' => 'required', // Validar que se envió el token
        ]);
        

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        // Verificar el token de reCAPTCHA
        $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => $recaptchaSecret,
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $recaptchaResult = $response->json();

        if (!$recaptchaResult['success']) {
            return $this->error_response('Verificación de reCAPTCHA fallida. Por favor, inténtelo de nuevo.');
        }

        $categoria = Categoria::findOrFail($request->categoria_id);
        $marca = Marca::findOrFail($request->marca_id);
        

        $data = [
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'empresa' => $request->empresa,
            'categoria' => $categoria->nombre,
            'marca' => $marca->nombre,
            'aclaraciones' => $request->aclaraciones,
        ];

        $archivosGuardados = [];
        if(!is_null($request->archivos)){
            foreach ($request->archivos as $archivo) {
                $archivoPath = $archivo->store('presupuestos', 'public');
                $archivosGuardados[] = $archivoPath;
            }
        
            // Añadir los archivos al array de datos
            $data['archivos'] = $archivosGuardados;
        }

        $contacto = Contacto::first();

        Mail::to($contacto->correo ?? 'example@gmail.com')->queue(new PresupuestoMail($data));

        return $this->success_response('Información enviada correctamente.', $data);
    }
 
}
