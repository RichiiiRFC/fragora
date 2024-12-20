<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\ProductoClienteController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\MetodoEnvioController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AuthoritationAdmin;
use App\Http\Controllers\PayPalController;



// ADMIN

// Rutas de login para admin
Route::view('admin/login', "admin.login")->name('admin-login');


// Grupo de rutas para admin
Route::prefix('admin')
    ->name('admin.')
    ->middleware(AuthoritationAdmin::class)
    ->group(function () {
        Route::view('/', "admin.inicio")->name('inicio');
        Route::resource('productos', ProductoController::class);
        Route::resource('usuarios', UserController::class);
        Route::resource('pedidos', PedidoController::class);
        Route::resource('metodos_pago', MetodoPagoController::class);
        Route::resource('metodos_envio', MetodoEnvioController::class);
    });


// Rutas de login y logout para admin
Route::post('/inicia-sesion-admin', [LoginAdminController::class, 'login'])->name('inicia-sesion-admin');
Route::get('/admin/logout-admin', [LoginAdminController::class, 'logout'])->name('logout-admin');


// CLIENTE

// Autenticación Cliente
Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-registro');
Route::post('/inicia-sesion', [LoginController::class, 'login'])->name('inicia-sesion');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


//Páginas de la tienda
Route::get('/', [ProductoClienteController::class, 'listaProductos'])->name('inicio');
Route::get('/perfumes/hombre', [ProductoClienteController::class, 'productosHombre'])->name('perfumes-hombre');
Route::get('/perfumes/mujer', [ProductoClienteController::class, 'productosMujer'])->name('perfumes-mujer');
Route::get('/producto/{id}', [ProductoClienteController::class, 'fichaProducto'])->name('ficha.producto');


Route::view('/login', "cliente.login")->name('login');
Route::view('/registro', "cliente.register")->name('registro');
Route::view('/privada', "cliente.privada")->middleware('auth')->name('privada');


// Datos cliente

Route::middleware(['auth'])->group(function () {
    Route::view('/miperfil', "cliente.perfil")->name('miperfil');
    Route::view('/midireccion', "cliente.direccion")->name('midireccion');
    Route::view('/mispedidos', "cliente.pedidos")->name('mispedidos');
    Route::get('/pedidos/detalles/{pedido}/', [PedidoClienteController::class, 'verDetallesPedido'])->name('detalles-pedido');

    Route::put('/miperfil', [ClienteController::class, 'updatePerfil'])->name('perfil.update');
    Route::put('/midireccion', [ClienteController::class, 'updateDireccion'])->name('direccion.update');
});



//CARRITO
Route::post('/producto/{id}/agregar-carrito', [CarritoController::class, 'agregarCarrito'])->name('agregarCarrito');
Route::get('/carrito', [CarritoController::class, 'verCarrito'])->name('carrito');
Route::delete('/eliminar-producto-carrito/{id}', [CarritoController::class, 'eliminarProductoCarrito'])->name('eliminar.producto.carrito');
Route::get('/carrito/cantidad', [CarritoController::class, 'obtenerCantidadCarrito'])->name('carrito.cantidad');



//PROCESO DE COMPRA
Route::get('/checkout', [PedidoClienteController::class, 'mostrarCheckout'])->name('checkout');
Route::post('/crear-pedido', [PedidoClienteController::class, 'crearPedido'])->name('crear_pedido');

//PAYPAL
Route::get('/paypal/payment/success', [PedidoClienteController::class, 'paymentSuccess'])->name('paypal.payment.success');
Route::get('/paypal/payment/cancel', [PedidoClienteController::class, 'paymentCancel'])->name('paypal.payment.cancel');

//SECCIONES LEGALES
Route::view('/aviso-legal', 'legal.aviso-legal')->name('aviso-legal');
Route::view('/terminos-condiciones', 'legal.terminos-condiciones')->name('terminos-condiciones');
Route::view('/politica-privacidad', 'legal.politica-privacidad')->name('politica-privacidad');
Route::view('/politica-cookies', 'legal.politica-cookies')->name('politica-cookies');