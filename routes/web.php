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

    //empleados
    Route::post('empleado/store',[App\Http\Controllers\EmpleadoController::class,'store'])->name('empleados.store')->middleware('permission:empleados.create');
    Route::get('empleados',[App\Http\Controllers\EmpleadoController::class,'index'])->name('empleados.index')->middleware('permission:empleados.index');
    Route::get('empleado/create',[App\Http\Controllers\EmpleadoController::class,'create'])->name('empleados.create')->middleware('permission:empleados.create');
    Route::put('empleado/{empleado}',[App\Http\Controllers\EmpleadoController::class,'update'])->name('empleados.update')->middleware('permission:empleados.edit');
    Route::get('empleado/{empleado}',[App\Http\Controllers\EmpleadoController::class,'show'])->name('empleados.show')->middleware('permission:empleados.show');
    Route::delete('empleado/{empleado}',[App\Http\Controllers\EmpleadoController::class,'destroy'])->name('empleados.destroy')->middleware('permission:empleados.destroy');
    Route::get('empleado/{empleado}/edit',[App\Http\Controllers\EmpleadoController::class,'edit'])->name('empleados.edit')->middleware('permission:empleados.edit');
    Route::post('empleado_ficha/store',[App\Http\Controllers\EmpleadoController::class,'ficha_store'])->name('ficha_firmada.store')->middleware('permission:empleados.create');
    Route::get('empleado_ficha/{empleado}',[App\Http\Controllers\EmpleadoController::class,'ficha'])->name('empleados.ficha')->middleware('permission:empleados.show');
    Route::get('provincia',[App\Http\Controllers\EmpleadoController::class,'obtener_provincia'])->name('provincia');
    Route::get('tipo_cargo',[App\Http\Controllers\EmpleadoController::class,'obtener_tipo_cargo'])->name('tipo_cargo');
    Route::get('obtener_cargos',[App\Http\Controllers\EmpleadoController::class,'obtener_cargos'])->name('obtener_cargos');
    Route::post('tipo_parentesco',[App\Http\Controllers\EmpleadoController::class,'tipo_parentesco'])->name('tipo_parentesco');
    Route::post('cargo_store',[App\Http\Controllers\EmpleadoController::class,'cargo_store'])->name('cargo_store');
    
    //declaraciones
    Route::post('declaracion_jurada/store',[App\Http\Controllers\DeclaracionJuradaController::class,'store'])->name('declaraciones.store')->middleware('permission:declaraciones.create');
    Route::get('declaracion_jurada/{empleado}/add',[App\Http\Controllers\DeclaracionJuradaController::class,'create'])->name('declaraciones.create')->middleware('permission:declaraciones.create');
    Route::get('todas_declaraciones/{empleado}',[App\Http\Controllers\DeclaracionJuradaController::class,'show'])->name('declaraciones.show')->middleware('permission:declaraciones.show');
    Route::delete('declaracion_jurada/{declaracionJurada}',[App\Http\Controllers\DeclaracionJuradaController::class,'destroy'])->name('declaraciones.destroy')->middleware('permission:declaraciones.destroy');
    Route::get('declaraciones',[App\Http\Controllers\DeclaracionJuradaController::class,'index'])->name('declaraciones.index')->middleware('permission:declaraciones.index');
    Route::post('buscar_empleados',[App\Http\Controllers\DeclaracionJuradaController::class,'buscar_empleado'])->name('buscar_empleados')->middleware('permission:declaraciones.show');
   
    //documentacion
    Route::post('documentacion/store',[App\Http\Controllers\DocumentacionController::class,'store'])->name('documentos.store')->middleware('permission:documentos.create');
    Route::get('documentacion_recepcionada',[App\Http\Controllers\DocumentacionController::class,'index'])->name('documentos.index')->middleware('permission:documentos.index');
    Route::get('documentacion_recepcionada/empleados',[App\Http\Controllers\DocumentacionController::class,'empleados'])->name('documentos_empleados.index')->middleware('permission:documentos.index');
    Route::get('documentacion/{empleado}/create',[App\Http\Controllers\DocumentacionController::class,'create'])->name('documentos.create')->middleware('permission:documentos.create');
    Route::put('documentacion/{documentacion}',[App\Http\Controllers\DocumentacionController::class,'update'])->name('documentos.update')->middleware('permission:documentos.edit');
    Route::get('documentacion/{documentacion}',[App\Http\Controllers\DocumentacionController::class,'show'])->name('documentos.show')->middleware('permission:documentos.show');
    Route::delete('documentacion/{documentacion}',[App\Http\Controllers\DocumentacionController::class,'destroy'])->name('documentos.destroy')->middleware('permission:documentos.destroy');
    Route::get('documentacion/{documentacion}/edit',[App\Http\Controllers\DocumentacionController::class,'edit'])->name('documentos.edit')->middleware('permission:documentos.edit');

    //parametricas
    //aeropuertos
    Route::get('aeropuertos',[App\Http\Controllers\AeropuertoController::class,'index'])->name('aeropuertos.index');
    Route::get('aeropuertos/create',[App\Http\Controllers\AeropuertoController::class,'create'])->name('aeropuertos.create');
    Route::post('aeropuertos/store',[App\Http\Controllers\AeropuertoController::class,'store'])->name('aeropuertos.store');
    Route::get('aeropuertos/{aeropuerto}/edit',[App\Http\Controllers\AeropuertoController::class,'edit'])->name('aeropuertos.edit');
    Route::put('aeropuertos/{aeropuerto}',[App\Http\Controllers\AeropuertoController::class,'update'])->name('aeropuertos.update');
    Route::delete('aeropuertos/{aeropuerto}',[App\Http\Controllers\AeropuertoController::class,'destroy'])->name('aeropuertos.destroy');
    //expensas
    Route::get('expensas',[App\Http\Controllers\ExpensaController::class,'index'])->name('expensas.index');
    Route::get('expensas/create',[App\Http\Controllers\ExpensaController::class,'create'])->name('expensas.create');
    Route::post('expensas/store',[App\Http\Controllers\ExpensaController::class,'store'])->name('expensas.store');
    Route::get('expensas/{expensa}/edit',[App\Http\Controllers\ExpensaController::class,'edit'])->name('expensas.edit');
    Route::put('expensas/{expensa}',[App\Http\Controllers\ExpensaController::class,'update'])->name('expensas.update');
    Route::delete('expensas/{expensa}',[App\Http\Controllers\ExpensaController::class,'destroy'])->name('expensas.destroy');
    //formas de pago
    Route::get('formaspago',[App\Http\Controllers\FormaPagoController::class,'index'])->name('formaspago.index');
    Route::get('formaspago/create',[App\Http\Controllers\FormaPagoController::class,'create'])->name('formaspago.create');
    Route::post('formaspago/store',[App\Http\Controllers\FormaPagoController::class,'store'])->name('formaspago.store');
    Route::get('formaspago/{formapago}/edit',[App\Http\Controllers\FormaPagoController::class,'edit'])->name('formaspago.edit');
    Route::put('formaspago/{formapago}',[App\Http\Controllers\FormaPagoController::class,'update'])->name('formaspago.update');
    Route::delete('formaspago/{formapago}',[App\Http\Controllers\FormaPagoController::class,'destroy'])->name('formaspago.destroy');
    //regional
    Route::get('regionales',[App\Http\Controllers\RegionalController::class,'index'])->name('regionales.index');
    Route::get('regionales/create',[App\Http\Controllers\RegionalController::class,'create'])->name('regionales.create');
    Route::post('regionales/store',[App\Http\Controllers\RegionalController::class,'store'])->name('regionales.store');
    Route::get('regionales/{regional}/edit',[App\Http\Controllers\RegionalController::class,'edit'])->name('regionales.edit');
    Route::put('regionales/{regional}',[App\Http\Controllers\RegionalController::class,'update'])->name('regionales.update');
    Route::delete('regionales/{regional}',[App\Http\Controllers\RegionalController::class,'destroy'])->name('regionales.destroy');
    //rubros
    Route::get('rubros',[App\Http\Controllers\RubroController::class,'index'])->name('rubros.index');
    Route::get('rubros/create',[App\Http\Controllers\RubroController::class,'create'])->name('rubros.create');
    Route::post('rubros/store',[App\Http\Controllers\RubroController::class,'store'])->name('rubros.store');
    Route::get('rubros/{rubro}/edit',[App\Http\Controllers\RubroController::class,'edit'])->name('rubros.edit');
    Route::put('rubros/{rubro}',[App\Http\Controllers\RubroController::class,'update'])->name('rubros.update');
    Route::delete('rubros/{rubro}',[App\Http\Controllers\RubroController::class,'destroy'])->name('rubros.destroy');
    //tipos de pago
    Route::get('tipospago',[App\Http\Controllers\TipoPagoController::class,'index'])->name('tipospago.index');
    Route::get('tipospago/create',[App\Http\Controllers\TipoPagoController::class,'create'])->name('tipospago.create');
    Route::post('tipospago/store',[App\Http\Controllers\TipoPagoController::class,'store'])->name('tipospago.store');
    Route::get('tipospago/{tipopago}/edit',[App\Http\Controllers\TipoPagoController::class,'edit'])->name('tipospago.edit');
    Route::put('tipospago/{tipopago}',[App\Http\Controllers\TipoPagoController::class,'update'])->name('tipospago.update');
    Route::delete('tipospago/{tipopago}',[App\Http\Controllers\TipoPagoController::class,'destroy'])->name('tipospago.destroy');
    //unidad de medida
    Route::get('unidadesmedida',[App\Http\Controllers\UnidadMedidaController::class,'index'])->name('unidadesmedida.index');
    Route::get('unidadesmedida/create',[App\Http\Controllers\UnidadMedidaController::class,'create'])->name('unidadesmedida.create');
    Route::post('unidadesmedida/store',[App\Http\Controllers\UnidadMedidaController::class,'store'])->name('unidadesmedida.store');
    Route::get('unidadesmedida/{unidadmedida}/edit',[App\Http\Controllers\UnidadMedidaController::class,'edit'])->name('unidadesmedida.edit');
    Route::put('unidadesmedida/{unidadmedida}',[App\Http\Controllers\UnidadMedidaController::class,'update'])->name('unidadesmedida.update');
    Route::delete('unidadesmedida/{unidadmedida}',[App\Http\Controllers\UnidadMedidaController::class,'destroy'])->name('unidadesmedida.destroy');
});
