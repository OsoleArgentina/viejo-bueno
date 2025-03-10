<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;

abstract class Controller
{
    public function success_response($message, $data = null): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'records' => $data,
        ], 200);
    }

    public function error_response($message = ''): JsonResponse
    {
        return response()->json([
            'message' => $message,
        ], 200);
    }
}
