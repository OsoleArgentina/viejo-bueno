<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\HomeController;

Route::get('/', function () {
    return view('site.site');
});

Route::get('/admin', [AdminAuthController::class, 'admin'])->name('admin');

Route::get('/login/admin', function () {
    return view('auth.Login');
});

Route::post('/login', [AdminAuthController::class, 'login'])->name('login');


Route::middleware('auth_admin')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('admin.admin', ['user' => auth()->user()]);
    })->name('dashboard');

    // Home
    Route::get('/get_sliders', [HomeController::class, 'get_sliders'])->name('get_sliders');
    Route::post('/set_slider', [HomeController::class, 'set_slider'])->name('set_slider');
    Route::post('/edit_slider', [HomeController::class, 'edit_slider'])->name('edit_slider');
    Route::delete('/delete_slider', [HomeController::class, 'delete_slider'])->name('delete_slider');
});
