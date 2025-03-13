<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\SubcategoriasController;
use App\Http\Controllers\ProductosController;

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
    Route::get('/get_categorias', [CategoriasController::class, 'get_categorias'])->name('get_categorias');
    Route::post('/create_categoria', [CategoriasController::class, 'create_categoria'])->name('create_categoria');
    Route::post('/edit_categoria', [CategoriasController::class, 'edit_categoria'])->name('edit_categoria');
    Route::delete('/delete_categoria', [CategoriasController::class, 'delete_categoria'])->name('delete_categoria');

    // SUBCATEGORIAS
    Route::get('/get_subcategorias', [SubcategoriasController::class, 'get_subcategorias'])->name('get_subcategorias');
    Route::post('/create_subcategoria', [SubcategoriasController::class, 'create_subcategoria'])->name('create_subcategoria');
    Route::post('/edit_subcategoria', [SubcategoriasController::class, 'edit_subcategoria'])->name('edit_subcategoria');
    Route::delete('/delete_subcategoria', [SubcategoriasController::class, 'delete_subcategoria'])->name('delete_subcategoria');

    // PRODUCTOS
    Route::get('/get_productos', [ProductosController::class, 'get_productos'])->name('get_productos');
    Route::get('/get_producto_by_id/{id}', [ProductosController::class, 'get_producto_by_id'])->name('get_producto_by_id');
    Route::post('/create_producto', [ProductosController::class, 'create_producto'])->name('create_producto');
    Route::post('/edit_producto', [ProductosController::class, 'edit_producto'])->name('edit_producto');
    Route::post('/edit_producto_destacado', [ProductosController::class, 'edit_producto_destacado'])->name('edit_producto_destacado');
    Route::delete('/delete_producto', [ProductosController::class, 'delete_producto'])->name('delete_producto');
    Route::post('/add_imagenes_producto', [ProductosController::class, 'add_imagenes_producto'])->name('add_imagenes_producto');
    Route::delete('/delete_imagen_producto', [ProductosController::class, 'delete_imagen_producto'])->name('delete_imagen_producto');

});
