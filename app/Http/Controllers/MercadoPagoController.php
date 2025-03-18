<?php

namespace App\Http\Controllers;

use Exception;
use MercadoPago;
use Illuminate\Http\Request;
use MercadoPago\Client\Common\RequestOptions;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
class MercadoPagoController extends Controller
{
    public function createPreference(Request $request)
    {
        MercadoPagoConfig::setAccessToken(env('MP_ACCESS_TOKEN'));

        $client = new PreferenceClient();

        $request = [
            "items" => collect($request->pedido)->map(function ($producto) {
                return [
                    "title" => $producto['nombre'],  
                    "unit_price" => (float) $producto['precio'],
                    "quantity" => (int) $producto['cantidad'], 
                ];
            })->toArray(),
        ];

        try {
            $preference = $client->create($request);
        } catch (MPApiException $MPApiException) {
            throw new Exception($MPApiException->getMessage(), $MPApiException->getStatusCode());
        }

        return response()->json(['preference' => $preference]);
    }

    // Métodos para las vistas de éxito, error y pendiente
    public function success()
    {
        return view('mercadopago.success');
    }

    public function failure()
    {
        return view('mercadopago.failure');
    }

    public function pending()
    {
        return view('mercadopago.pending');
    }
}
