<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\SubcategoriasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\NovedadesController;
use App\Http\Controllers\CapacitacionesController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MetadatosController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PresupuestoController;
use App\Http\Controllers\PopUpController;

Route::get('/', function () {
    return view('site.site');
});

Route::get('/admin', [AdminAuthController::class, 'admin'])->name('admin');

Route::get('/login/admin', function () {
    return view('auth.Login');
});

Route::post('/login', [AdminAuthController::class, 'login'])->name('login');

// PUBLIC
Route::get('/get_sliders', [HomeController::class, 'get_sliders'])->name('get_sliders');
Route::get('/get_home_nosotros', [HomeController::class, 'get_home_nosotros'])->name('get_home_nosotros');
Route::get('/get_categorias_destacadas', [CategoriasController::class, 'get_categorias_destacadas'])->name('get_categorias_destacadas');
Route::get('/get_marcas_destacadas', [MarcasController::class, 'get_marcas_destacadas'])->name('get_marcas_destacadas');
Route::get('/get_productos_destacadas', [ProductosController::class, 'get_productos_destacadas'])->name('get_productos_destacadas');
Route::get('/get_productos', [ProductosController::class, 'get_productos'])->name('get_productos');
Route::get('/get_productos_relacionados/{id}', [ProductosController::class, 'get_productos_relacionados'])->name('get_productos_relacionados');
Route::post('/create_pedido', [CarritoController::class, 'create_pedido'])->name('create_pedido');
Route::post('/enviar_informacion_contacto', [ContactoController::class, 'enviar_informacion_contacto'])->name('enviar_informacion_contacto');
Route::post('/solicitar_presupuesto', [PresupuestoController::class, 'solicitar_presupuesto'])->name('solicitar_presupuesto');
Route::get('/get_metadatos', [MetadatosController::class, 'get_metadatos'])->name('get_metadatos');
Route::get('/get_contacto', [ContactoController::class, 'get_contacto'])->name('get_contacto');
Route::get('/get_nosotros', [NosotrosController::class, 'get_nosotros'])->name('get_nosotros');
Route::get('/get_marcas', [MarcasController::class, 'get_marcas'])->name('get_marcas');
Route::get('/get_novedades', [NovedadesController::class, 'get_novedades'])->name('get_novedades');
Route::get('/get_capacitaciones', [CapacitacionesController::class, 'get_capacitaciones'])->name('get_capacitaciones');
Route::get('/get_categorias', [CategoriasController::class, 'get_categorias'])->name('get_categorias');
Route::get('/get_popup', [PopUpController::class, 'get_popup'])->name('get_popup');

// MERCADO PAGO
Route::post('/createPreference', [MercadoPagoController::class, 'createPreference'])->name('createPreference');

Route::middleware('auth_admin')->group(function () {
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('admin.admin', ['user' => auth()->user()]);
    })->name('dashboard');

    // slider - HOME
    Route::post('/set_slider', [HomeController::class, 'set_slider'])->name('set_slider');
    Route::post('/edit_slider', [HomeController::class, 'edit_slider'])->name('edit_slider');
    Route::delete('/delete_slider', [HomeController::class, 'delete_slider'])->name('delete_slider');
    // nosotros - HOME
    Route::post('/set_home_nosotros', [HomeController::class, 'set_home_nosotros'])->name('set_home_nosotros');

    // NOSOTROS
    Route::post('/set_nosotros', [NosotrosController::class, 'set_nosotros'])->name('set_nosotros');
    //ELEGIRNOS
    Route::get('/get_nosotros_elegirnos', [NosotrosController::class, 'get_nosotros_elegirnos'])->name('get_nosotros_elegirnos');
    Route::post('/create_elegirnos', [NosotrosController::class, 'create_elegirnos'])->name('create_elegirnos');
    Route::post('/edit_elegirnos', [NosotrosController::class, 'edit_elegirnos'])->name('edit_elegirnos');
    Route::delete('/delete_elegirnos', [NosotrosController::class, 'delete_elegirnos'])->name('delete_elegirnos');

    // CATEGORIAS
    Route::post('/create_categoria', [CategoriasController::class, 'create_categoria'])->name('create_categoria');
    Route::post('/edit_categoria', [CategoriasController::class, 'edit_categoria'])->name('edit_categoria');
    Route::post('/edit_categoria_destacado', [CategoriasController::class, 'edit_categoria_destacado'])->name('edit_categoria_destacado');
    Route::delete('/delete_categoria', [CategoriasController::class, 'delete_categoria'])->name('delete_categoria');

    // SUBCATEGORIAS
    Route::get('/get_subcategorias', [SubcategoriasController::class, 'get_subcategorias'])->name('get_subcategorias');
    Route::post('/create_subcategoria', [SubcategoriasController::class, 'create_subcategoria'])->name('create_subcategoria');
    Route::post('/edit_subcategoria', [SubcategoriasController::class, 'edit_subcategoria'])->name('edit_subcategoria');
    Route::delete('/delete_subcategoria', [SubcategoriasController::class, 'delete_subcategoria'])->name('delete_subcategoria');

    // PRODUCTOS
    Route::get('/get_producto_by_id/{id}', [ProductosController::class, 'get_producto_by_id'])->name('get_producto_by_id');
    Route::post('/create_producto', [ProductosController::class, 'create_producto'])->name('create_producto');
    Route::post('/edit_producto', [ProductosController::class, 'edit_producto'])->name('edit_producto');
    Route::post('/edit_producto_destacado', [ProductosController::class, 'edit_producto_destacado'])->name('edit_producto_destacado');
    Route::delete('/delete_producto', [ProductosController::class, 'delete_producto'])->name('delete_producto');
    Route::post('/add_imagenes_producto', [ProductosController::class, 'add_imagenes_producto'])->name('add_imagenes_producto');
    Route::delete('/delete_imagen_producto', [ProductosController::class, 'delete_imagen_producto'])->name('delete_imagen_producto');

    // MARCAS
    Route::post('/create_marca', [MarcasController::class, 'create_marca'])->name('create_marca');
    Route::post('/edit_marca', [MarcasController::class, 'edit_marca'])->name('edit_marca');
    Route::post('/edit_marca_destacado', [MarcasController::class, 'edit_marca_destacado'])->name('edit_marca_destacado');
    Route::delete('/delete_marca', [MarcasController::class, 'delete_marca'])->name('delete_marca');

    // NOVEDADES
    Route::post('/create_novedad', [NovedadesController::class, 'create_novedad'])->name('create_novedad');
    Route::post('/edit_novedad', [NovedadesController::class, 'edit_novedad'])->name('edit_novedad');
    Route::delete('/delete_novedad', [NovedadesController::class, 'delete_novedad'])->name('delete_novedad');

    // CAPACITACIONES
    Route::post('/create_capacitacion', [CapacitacionesController::class, 'create_capacitacion'])->name('create_capacitacion');
    Route::post('/edit_capacitacion', [CapacitacionesController::class, 'edit_capacitacion'])->name('edit_capacitacion');
    Route::delete('/delete_capacitacion', [CapacitacionesController::class, 'delete_capacitacion'])->name('delete_capacitacion');

    // CONTACTO
    Route::post('/set_contacto', [ContactoController::class, 'set_contacto'])->name('set_contacto');

    // ADMINS
    Route::get('/get_admins', [AdminController::class, 'get_admins'])->name('get_admins')->middleware('manage_admin');
    Route::post('/create_admin', [AdminController::class, 'create_admin'])->name('create_admin')->middleware('manage_admin');
    Route::post('/edit_super_admin', [AdminController::class, 'edit_super_admin'])->name('edit_super_admin')->middleware('manage_admin');
    Route::post('/edit_admin', [AdminController::class, 'edit_admin'])->name('edit_admin')->middleware('manage_admin');
    Route::delete('/delete_admin', [AdminController::class, 'delete_admin'])->name('delete_admin')->middleware('manage_admin');

    // METADATOS
    Route::post('/edit_metadato', [MetadatosController::class, 'edit_metadato'])->name('edit_metadato');

    // POPUP
    Route::post('/set_popup', [PopUpController::class, 'set_popup'])->name('set_popup');
});

