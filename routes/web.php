<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BocadilloController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Ingrediente_ExtraController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Detalles_ticketController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ElaboracionController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\PaymentController;

use App\Models\Payment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::post('pay' , [PaymentController::class, 'pay'])->name('payment.pay');
Route::get('payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
Route::post('/paypal/pay', 'App\Http\Controllers\PaymentController@pay');

Route::post('/verificarDisponibilidad', [BocadilloController::class, 'verificarDisponibilidad'])->name('verificarDisponibilidad');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/logout', [ProfileController::class, 'logout'])->name('profile.logout')->middleware(['auth']);
});

Route::controller(BocadilloController::class)->group(function () {
    Route::get('/bocadillos', 'index')->name('bocadillos.index');
    Route::post('/bocadillos', 'store')->name('bocadillos.store')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/bocadillos/listado', 'listado')->name('bocadillos.listado')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/bocadillos/create',  'create')->name('bocadillos.create')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/bocadillos/{bocadillo}', 'show')->name('bocadillos.show');
    Route::put('/bocadillos/{bocadillo}', 'update')->name('bocadillos.update')->middleware(['auth'])->middleware(['role:administrador']);
    Route::delete('/bocadillos/{bocadillo}', 'destroy')->name('bocadillos.destroy')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/bocadillos/{bocadillo}/edit', 'edit')->name('bocadillos.edit')->middleware(['auth'])->middleware(['role:administrador']);
});

Route::controller(CategoriaController::class)->group(function () {
    Route::get('/categorias', 'index')->name('categorias.index');
    Route::post('/categorias', 'store')->name('categorias.store')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/categorias/create',  'create')->name('categorias.create')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/categorias/{categoria}', 'show')->name('categorias.show');
    Route::put('/categorias/{categoria}', 'update')->name('categorias.update')->middleware(['auth'])->middleware(['role:administrador']);
    Route::delete('/categorias/{categoria}', 'destroy')->name('categorias.destroy')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/categorias/{categoria}/edit', 'edit')->name('categorias.edit')->middleware(['auth'])->middleware(['role:administrador']);
});

Route::controller(TipoController::class)->group(function () {
    Route::get('/tipos', 'index')->name('tipos.index');
    Route::post('/tipos', 'store')->name('tipos.store')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/tipos/create',  'create')->name('tipos.create')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/tipos/{tipo}', 'show')->name('tipos.show');
    Route::put('/tipos/{tipo}', 'update')->name('tipos.update')->middleware(['auth'])->middleware(['role:administrador']);
    Route::delete('/tipo/{tipo}', 'destroy')->name('tipos.destroy')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/tipos/{tipo}/edit', 'edit')->name('tipos.edit')->middleware(['auth'])->middleware(['role:administrador']);
});

Route::controller(ElaboracionController::class)->group(function () {
    Route::get('/elaboracion', 'index')->name('elaboracion.index');
    Route::post('/elaboracion', 'store')->name('elaboracion.store')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/elaboracion/create',  'create')->name('elaboracion.create')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/elaboracion/{elaboracion}', 'show')->name('elaboracion.show');
    Route::put('/elaboracion/{elaboracion}', 'update')->name('elaboracion.update')->middleware(['auth'])->middleware(['role:administrador']);
    Route::delete('/elaboracion/{elaboracion}', 'destroy')->name('elaboracion.destroy')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/elaboracion/{elaboracion}/edit', 'edit')->name('elaboracion.edit')->middleware(['auth'])->middleware(['role:administrador']);
});

Route::controller(IngredienteController::class)->group(function () {
    Route::get('/ingredientes/editall', 'editall')->name('ingredientes.editall')->middleware(['auth'])->middleware(['role:administrador']);
    Route::put('/ingredientes/updateall', 'updateall')->name('ingredientes.updateAll')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/ingredientes', 'index')->name('ingredientes.index')->middleware(['auth'])->middleware(['role:administrador']);
    Route::post('/ingredientes', 'store')->name('ingredientes.store')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/ingredientes/create',  'create')->name('ingredientes.create')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/ingredientes/{ingrediente}', 'show')->name('ingredientes.show')->middleware(['auth'])->middleware(['role:administrador']);
    Route::put('/ingredientes/{ingrediente}', 'update')->name('ingredientes.update')->middleware(['auth'])->middleware(['role:administrador']);
    Route::delete('/ingredientes/{ingrediente}', 'destroy')->name('ingredientes.destroy')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/ingredientes/{ingrediente}/edit', 'edit')->name('ingredientes.edit')->middleware(['auth'])->middleware(['role:administrador']);
});
//falta por desarrollar
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('users.index');
    Route::post('/users', 'store')->name('users.store');
    Route::get('/users/create',  'create')->name('users.create');
    Route::get('/users/{user}', 'show')->name('users.show');
    Route::put('/users/{user}', 'update')->name('users.update');
    Route::delete('/users/{user}', 'destroy')->name('users.destroy');
    Route::get('/users/{user}/edit', 'edit')->name('users.edit');
});

Route::controller(Ingrediente_ExtraController::class)->group(function () {
    Route::get('/extras', 'index')->name('extras.index')->middleware(['auth'])->middleware(['role:administrador']);
    Route::put('/extras/updateall', 'updateall')->name('extras.updateAll')->middleware(['auth'])->middleware(['role:administrador']);
    Route::post('/extras', 'store')->name('extras.store')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/extras/create',  'create')->name('extras.create')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/extras/{extra}', 'show')->name('extras.show')->middleware(['auth'])->middleware(['role:administrador']);
    Route::put('/extras/{extra}', 'update')->name('extras.update')->middleware(['auth'])->middleware(['role:administrador']);
    Route::delete('/extras/{extra}', 'destroy')->name('extras.destroy')->middleware(['auth'])->middleware(['role:administrador']);
    Route::get('/extras/{extra}/edit', 'edit')->name('extras.edit')->middleware(['auth'])->middleware(['role:administrador']);
});
//falta por desarrollar
Route::controller(TicketController::class)->group(function () {
    Route::get('/tickets', 'index')->name('tickets.index');
    Route::post('/tickets', 'store')->name('tickets.store');
    Route::get('/tickets/create',  'create')->name('tickets.create');
    Route::get('/tickets/{ticket}', 'show')->name('tickets.show');
    Route::put('/tickets/{ticket}', 'update')->name('tickets.update');
    Route::delete('/tickets/{ticket}', 'destroy')->name('tickets.destroy');
    Route::get('/tickets/{ticket}/edit', 'edit')->name('tickets.edit');
});
//falta por desarrollar
Route::controller(Detalles_ticketController::class)->group(function () {
    Route::get('/detalles', 'index')->name('detalles.index');
    Route::post('/detalles', 'store')->name('detalles.store');
    Route::get('/detalles/create',  'create')->name('detalles.create');
    Route::get('/detalles/{detalle}', 'show')->name('detalles.show');
    Route::put('/detalles/{detalle}', 'update')->name('detalles.update');
    Route::delete('/detalles/{detalle}', 'destroy')->name('detalles.destroy');
    Route::get('/detalles/{detalle}/edit', 'edit')->name('detalles.edit');
});

Route::controller(CartController::class)->group(function () {
    Route::post('/cart/add', 'add')->name('carrito.add')->middleware(['auth'])->middleware(['role:cliente']);
    Route::get('/cart/checkout', 'checkout')->name('carrito.checkout')->middleware(['auth'])->middleware(['role:cliente']);
    Route::get('/cart/clear', 'clear')->name('carrito.clear')->middleware(['auth'])->middleware(['role:cliente']);
    Route::delete('/cart/remove/{rowId}', 'remove')->name('carrito.remove')->middleware(['auth'])->middleware(['role:cliente']);
});

Route::get('/ajax', AjaxController::class)->name('ajax.precio');

require __DIR__.'/auth.php';
