<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //Roles
    Route::post('roles/store',[App\Http\Controllers\RoleController::class,'store'])->name('roles.store')->middleware('permission:roles.create');
    Route::get('roles',[App\Http\Controllers\RoleController::class,'index'])->name('roles.index')->middleware('permission:roles.index');
    Route::get('roles/create',[App\Http\Controllers\RoleController::class,'create'])->name('roles.create')->middleware('permission:roles.create');
    Route::put('roles/{role}',[App\Http\Controllers\RoleController::class,'update'])->name('roles.update')->middleware('permission:roles.edit');
    Route::get('roles/{role}',[App\Http\Controllers\RoleController::class,'show'])->name('roles.show')->middleware('permission:roles.show');
    Route::delete('roles/{role}',[App\Http\Controllers\RoleController::class,'destroy'])->name('roles.destroy')->middleware('permission:roles.destroy');
    Route::get('roles/{role}/edit',[App\Http\Controllers\RoleController::class,'edit'])->name('roles.edit')->middleware('permission:roles.edit');

    //User
    Route::post('users/store',[App\Http\Controllers\UserController::class,'store'])->name('users.store')->middleware('permission:users.create');
    Route::get('users',[App\Http\Controllers\UserController::class,'index'])->name('users.index')->middleware('permission:users.index');
    Route::get('users/create',[App\Http\Controllers\UserController::class,'create'])->name('users.create')->middleware('permission:users.create');
    Route::put('users/{user}',[App\Http\Controllers\UserController::class,'update'])->name('users.update')->middleware('permission:users.edit');
    Route::get('users/{user}',[App\Http\Controllers\UserController::class,'show'])->name('users.show')->middleware('permission:users.show');
    Route::get('usuario/{user}',[App\Http\Controllers\UserController::class,'destroy'])->name('users.destroy')->middleware('permission:users.destroy');
    Route::get('users/{user}/edit',[App\Http\Controllers\UserController::class,'edit'])->name('users.edit')->middleware('permission:users.edit');

    //Permisos
    Route::post('permisos/store',[App\Http\Controllers\PermissionController::class,'store'])->name('permisos.store')->middleware('permission:permisos.create');
    Route::get('permisos',[App\Http\Controllers\PermissionController::class,'index'])->name('permisos.index')->middleware('permission:permisos.index');
    Route::get('permisos/create',[App\Http\Controllers\PermissionController::class,'create'])->name('permisos.create')->middleware('permission:permisos.create');
    Route::put('permisos/{permiso}',[App\Http\Controllers\PermissionController::class,'update'])->name('permisos.update')->middleware('permission:permisos.edit');
    Route::get('permisos/{permiso}',[App\Http\Controllers\PermissionController::class,'show'])->name('permisos.show')->middleware('permission:permisos.show');
    Route::get('permisos/{permiso}/eliminar',[App\Http\Controllers\PermissionController::class,'destroy'])->name('permisos.destroy')->middleware('permission:permisos.destroy');
    Route::get('permisos/{permiso}/edit',[App\Http\Controllers\PermissionController::class,'edit'])->name('permisos.edit')->middleware('permission:permisos.edit');

    //parametricas
    //aeropuertos
    Route::get('aeropuertos',[App\Http\Controllers\AeropuertoController::class,'index'])->name('aeropuertos.index')->middleware('permission:aeropuertos.index');
    Route::get('aeropuertos/create',[App\Http\Controllers\AeropuertoController::class,'create'])->name('aeropuertos.create')->middleware('permission:aeropuertos.create');
    Route::post('aeropuertos/store',[App\Http\Controllers\AeropuertoController::class,'store'])->name('aeropuertos.store')->middleware('permission:aeropuertos.create');
    Route::get('aeropuertos/{aeropuerto}/edit',[App\Http\Controllers\AeropuertoController::class,'edit'])->name('aeropuertos.edit')->middleware('permission:aeropuertos.edit');
    Route::put('aeropuertos/{aeropuerto}',[App\Http\Controllers\AeropuertoController::class,'update'])->name('aeropuertos.update')->middleware('permission:aeropuertos.edit');
    Route::delete('aeropuertos/{aeropuerto}',[App\Http\Controllers\AeropuertoController::class,'destroy'])->name('aeropuertos.destroy')->middleware('permission:aeropuertos.destroy');
    Route::get('aeropuertos/pdf',[App\Http\Controllers\AeropuertoController::class,'show'])->name('aeropuertos.show')->middleware('permission:aeropuertos.show');
    Route::get('aeropuertos/xls',[App\Http\Controllers\AeropuertoController::class,'export'])->name('aeropuertos.export')->middleware('permission:aeropuertos.show');

    //clientes
    Route::get('clientes',[App\Http\Controllers\ClienteController::class,'index'])->name('clientes.index')->middleware('permission:clientes.index');
    Route::get('clientes/create',[App\Http\Controllers\ClienteController::class,'create'])->name('clientes.create')->middleware('permission:clientes.create');
    Route::post('clientes/store',[App\Http\Controllers\ClienteController::class,'store'])->name('clientes.store')->middleware('permission:clientes.create');
    Route::get('clientes/{cliente}/edit',[App\Http\Controllers\ClienteController::class,'edit'])->name('clientes.edit')->middleware('permission:clientes.edit');
    Route::put('clientes/{cliente}',[App\Http\Controllers\ClienteController::class,'update'])->name('clientes.update')->middleware('permission:clientes.edit');
    Route::delete('clientes/{cliente}',[App\Http\Controllers\ClienteController::class,'destroy'])->name('clientes.destroy')->middleware('permission:clientes.destroy');
    Route::get('clientes/pdf',[App\Http\Controllers\ClienteController::class,'show'])->name('clientes.show')->middleware('permission:clientes.show');
    Route::get('clientes/xls',[App\Http\Controllers\ClienteController::class,'export'])->name('clientes.export')->middleware('permission:clientes.show');

    //expensas
    Route::get('expensas',[App\Http\Controllers\ExpensaController::class,'index'])->name('expensas.index')->middleware('permission:expensas.index');
    Route::get('expensas/create',[App\Http\Controllers\ExpensaController::class,'create'])->name('expensas.create')->middleware('permission:expensas.create');
    Route::post('expensas/store',[App\Http\Controllers\ExpensaController::class,'store'])->name('expensas.store')->middleware('permission:expensas.create');
    Route::get('expensas/{expensa}/edit',[App\Http\Controllers\ExpensaController::class,'edit'])->name('expensas.edit')->middleware('permission:expensas.edit');
    Route::put('expensas/{expensa}',[App\Http\Controllers\ExpensaController::class,'update'])->name('expensas.update')->middleware('permission:expensas.edit');
    Route::delete('expensas/{expensa}',[App\Http\Controllers\ExpensaController::class,'destroy'])->name('expensas.destroy')->middleware('permission:expensas.destroy');
    Route::get('expensas/pdf',[App\Http\Controllers\ExpensaController::class,'show'])->name('expensas.show')->middleware('permission:expensas.show');
    Route::get('expensas/xls',[App\Http\Controllers\ExpensaController::class,'export'])->name('expensas.export')->middleware('permission:expensas.show');

    //formas de pago
    Route::get('formaspago',[App\Http\Controllers\FormaPagoController::class,'index'])->name('formaspago.index')->middleware('permission:formaspago.index');
    Route::get('formaspago/create',[App\Http\Controllers\FormaPagoController::class,'create'])->name('formaspago.create')->middleware('permission:formaspago.create');
    Route::post('formaspago/store',[App\Http\Controllers\FormaPagoController::class,'store'])->name('formaspago.store')->middleware('permission:formaspago.create');
    Route::get('formaspago/{formapago}/edit',[App\Http\Controllers\FormaPagoController::class,'edit'])->name('formaspago.edit')->middleware('permission:formaspago.edit');
    Route::put('formaspago/{formapago}',[App\Http\Controllers\FormaPagoController::class,'update'])->name('formaspago.update')->middleware('permission:formaspago.edit');
    Route::delete('formaspago/{formapago}',[App\Http\Controllers\FormaPagoController::class,'destroy'])->name('formaspago.destroy')->middleware('permission:formaspago.destroy');
    Route::get('formaspago/pdf',[App\Http\Controllers\FormaPagoController::class,'show'])->name('formaspago.show')->middleware('permission:formaspago.show');
    Route::get('formaspago/xls',[App\Http\Controllers\FormaPagoController::class,'export'])->name('formaspago.export')->middleware('permission:formaspago.show');

    //regional
    Route::get('regionales',[App\Http\Controllers\RegionalController::class,'index'])->name('regionales.index')->middleware('permission:regionales.index');
    Route::get('regionales/create',[App\Http\Controllers\RegionalController::class,'create'])->name('regionales.create')->middleware('permission:regionales.create');
    Route::post('regionales/store',[App\Http\Controllers\RegionalController::class,'store'])->name('regionales.store')->middleware('permission:regionales.create');
    Route::get('regionales/{regional}/edit',[App\Http\Controllers\RegionalController::class,'edit'])->name('regionales.edit')->middleware('permission:regionales.edit');
    Route::put('regionales/{regional}',[App\Http\Controllers\RegionalController::class,'update'])->name('regionales.update')->middleware('permission:regionales.edit');
    Route::delete('regionales/{regional}',[App\Http\Controllers\RegionalController::class,'destroy'])->name('regionales.destroy')->middleware('permission:regionales.destroy');
    Route::get('regionales/pdf',[App\Http\Controllers\RegionalController::class,'show'])->name('regionales.show')->middleware('permission:regionales.show');
    Route::get('regionales/xls',[App\Http\Controllers\RegionalController::class,'export'])->name('regionales.export')->middleware('permission:regionales.show');

    //rubros
    Route::get('rubros',[App\Http\Controllers\RubroController::class,'index'])->name('rubros.index')->middleware('permission:rubros.index');
    Route::get('rubros/create',[App\Http\Controllers\RubroController::class,'create'])->name('rubros.create')->middleware('permission:rubros.create');
    Route::post('rubros/store',[App\Http\Controllers\RubroController::class,'store'])->name('rubros.store')->middleware('permission:rubros.create');
    Route::get('rubros/{rubro}/edit',[App\Http\Controllers\RubroController::class,'edit'])->name('rubros.edit')->middleware('permission:rubros.edit');
    Route::put('rubros/{rubro}',[App\Http\Controllers\RubroController::class,'update'])->name('rubros.update')->middleware('permission:rubros.edit');
    Route::delete('rubros/{rubro}',[App\Http\Controllers\RubroController::class,'destroy'])->name('rubros.destroy')->middleware('permission:rubros.destroy');
    Route::get('rubros/pdf',[App\Http\Controllers\RubroController::class,'show'])->name('rubros.show')->middleware('permission:rubros.show');
    Route::get('rubros/xls',[App\Http\Controllers\RubroController::class,'export'])->name('rubros.export')->middleware('permission:rubros.show');

    //tipos de pago
    Route::get('tipospago',[App\Http\Controllers\TipoPagoController::class,'index'])->name('tipospago.index')->middleware('permission:tipospago.index');
    Route::get('tipospago/create',[App\Http\Controllers\TipoPagoController::class,'create'])->name('tipospago.create')->middleware('permission:tipospago.create');
    Route::post('tipospago/store',[App\Http\Controllers\TipoPagoController::class,'store'])->name('tipospago.store')->middleware('permission:tipospago.create');
    Route::get('tipospago/{tipopago}/edit',[App\Http\Controllers\TipoPagoController::class,'edit'])->name('tipospago.edit')->middleware('permission:tipospago.edit');
    Route::put('tipospago/{tipopago}',[App\Http\Controllers\TipoPagoController::class,'update'])->name('tipospago.update')->middleware('permission:tipospago.edit');
    Route::delete('tipospago/{tipopago}',[App\Http\Controllers\TipoPagoController::class,'destroy'])->name('tipospago.destroy')->middleware('permission:tipospago.destroy');
    Route::get('tipospago/pdf',[App\Http\Controllers\TipoPagoController::class,'show'])->name('tipospago.show')->middleware('permission:tipospago.show');
    Route::get('tipospago/xls',[App\Http\Controllers\TipoPagoController::class,'export'])->name('tipospago.export')->middleware('permission:tipospago.show');
    
    //unidad de medida
    Route::get('unidadesmedida',[App\Http\Controllers\UnidadMedidaController::class,'index'])->name('unidadesmedida.index')->middleware('permission:unidadesmedida.index');
    Route::get('unidadesmedida/create',[App\Http\Controllers\UnidadMedidaController::class,'create'])->name('unidadesmedida.create')->middleware('permission:unidadesmedida.create');
    Route::post('unidadesmedida/store',[App\Http\Controllers\UnidadMedidaController::class,'store'])->name('unidadesmedida.store')->middleware('permission:unidadesmedida.create');
    Route::get('unidadesmedida/{unidadmedida}/edit',[App\Http\Controllers\UnidadMedidaController::class,'edit'])->name('unidadesmedida.edit')->middleware('permission:unidadesmedida.edit');
    Route::put('unidadesmedida/{unidadmedida}',[App\Http\Controllers\UnidadMedidaController::class,'update'])->name('unidadesmedida.update')->middleware('permission:unidadesmedida.edit');
    Route::delete('unidadesmedida/{unidadmedida}',[App\Http\Controllers\UnidadMedidaController::class,'destroy'])->name('unidadesmedida.destroy')->middleware('permission:unidadesmedida.destroy');
    Route::get('unidadesmedida/pdf',[App\Http\Controllers\UnidadMedidaController::class,'show'])->name('unidadesmedida.show')->middleware('permission:unidadesmedida.show');
    Route::get('unidadesmedida/xls',[App\Http\Controllers\UnidadMedidaController::class,'export'])->name('unidadesmedida.export')->middleware('permission:unidadesmedida.show');
});
