<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginAdminRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    public function admin(Request $request)
    {
        if (!Auth::guard()->check()) {
            return redirect('/login/admin');
        }

        return redirect()->route('dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard()->attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->with('message_error', 'Los datos son incorrectos');
    }

    public function logout(Request $request)
    {
        Auth::guard()->logout();

        // $request->session()->invalidate();
        
        // $request->session()->regenerateToken();
        return $this->error_response('Sesion cerrada correctamente');
    }
}
