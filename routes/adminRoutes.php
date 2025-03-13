<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\CategoriaController;

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

    // slider - HOME
    Route::get('/get_sliders', [HomeController::class, 'get_sliders'])->name('get_sliders');
    Route::post('/set_slider', [HomeController::class, 'set_slider'])->name('set_slider');
    Route::post('/edit_slider', [HomeController::class, 'edit_slider'])->name('edit_slider');
    Route::delete('/delete_slider', [HomeController::class, 'delete_slider'])->name('delete_slider');
    // nosotros - HOME
    Route::get('/get_home_nosotros', [HomeController::class, 'get_home_nosotros'])->name('get_home_nosotros');
    Route::post('/set_home_nosotros', [HomeController::class, 'set_home_nosotros'])->name('set_home_nosotros');

    // NOSOTROS
    Route::get('/get_nosotros', [NosotrosController::class, 'get_nosotros'])->name('get_nosotros');
    Route::post('/set_nosotros', [NosotrosController::class, 'set_nosotros'])->name('set_nosotros');
    //ELEGIRNOS
    Route::get('/get_nosotros_elegirnos', [NosotrosController::class, 'get_nosotros_elegirnos'])->name('get_nosotros_elegirnos');
    Route::post('/create_elegirnos', [NosotrosController::class, 'create_elegirnos'])->name('create_elegirnos');
    Route::post('/edit_elegirnos', [NosotrosController::class, 'edit_elegirnos'])->name('edit_elegirnos');
    Route::delete('/delete_elegirnos', [NosotrosController::class, 'delete_elegirnos'])->name('delete_elegirnos');

    // CATEGORIAS
    Route::get('/get_categorias', [CategoriaController::class, 'get_categorias'])->name('get_categorias');
    Route::post('/create_categoria', [CategoriaController::class, 'create_categoria'])->name('create_categoria');
    Route::post('/edit_categoria', [CategoriaController::class, 'edit_categoria'])->name('edit_categoria');
    Route::delete('/delete_categoria', [CategoriaController::class, 'delete_categoria'])->name('delete_categoria');

});
