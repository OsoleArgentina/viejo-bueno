<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function get_admins(Request $request)
    {
        $admin = auth()->user();
        $admins = Admin::where('id', '!=', $admin->id)->get();
        return $this->success_response('', $admins);
    }

    public function create_admin(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string|confirmed',
            'password_confirmation' => 'required|string',
            'email' => 'required|string|email',
            'is_admin' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }
        $admin = Admin::create(
            [
                'username' => $request->username,     
                'password' => $request->password,     
                'email' => $request->email,     
                'is_admin' => $request->is_admin,     
            ]
        );

        return $this->success_response('Administrador creado correctamente.', $admin);
    }

    public function edit_super_admin(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'admin_id' => 'required',
            'is_admin' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $admin = Admin::findOrFail($request->admin_id);

        $admin->update([
            'is_admin' => $request->is_admin,
        ]);

        return $this->success_response('Administrador actualizado correctamente.', $admin);
    }
    
    public function edit_admin(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'admin_id' => 'required',
            'username' => 'required|string',
            'password' => 'sometimes|required|string|confirmed',
            'password_confirmation' => 'sometimes|required|string',
            'email' => 'required|string|email',
            'is_admin' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $admin = Admin::findOrFail($request->admin_id);

        $admin->update([
            'username' => $request->username,     
            'password' => $request->password ?  Hash::make($request->password) : $admin->password,     
            'email' => $request->email,     
            'is_admin' => $request->is_admin,  
        ]);

        return $this->success_response('Administrador actualizado correctamente.');
    }

    public function delete_admin(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'admin_id' => 'required',
        ]);
 
        if ($validator->fails()) {
            return $this->error_response($validator->messages()->first());
        }

        $admin = Admin::findOrFail($request->admin_id);

        $admin->delete();

        return $this->success_response('Administrador eliminado correctamente.');
    }
 
}
