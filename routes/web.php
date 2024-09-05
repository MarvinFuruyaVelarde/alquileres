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
    //expensas
    Route::get('expensas',[App\Http\Controllers\ExpensaController::class,'index'])->name('expensas.index');
    Route::get('expensas/create',[App\Http\Controllers\ExpensaController::class,'create'])->name('expensas.create');
    Route::post('expensas/store',[App\Http\Controllers\ExpensaController::class,'store'])->name('expensas.store');
    Route::get('expensas/{expensa}/edit',[App\Http\Controllers\ExpensaController::class,'edit'])->name('expensas.edit');
    Route::put('expensas/{expensa}',[App\Http\Controllers\ExpensaController::class,'update'])->name('expensas.update');
    Route::delete('expensas/{expensa}',[App\Http\Controllers\ExpensaController::class,'destroy'])->name('expensas.destroy');
    //regional
    Route::get('regionales',[App\Http\Controllers\RegionalController::class,'index'])->name('regionales.index');
    Route::get('regionales/create',[App\Http\Controllers\RegionalController::class,'create'])->name('regionales.create');
    Route::post('regionales/store',[App\Http\Controllers\RegionalController::class,'store'])->name('regionales.store');
    Route::get('regionales/{regional}/edit',[App\Http\Controllers\RegionalController::class,'edit'])->name('regionales.edit');
    Route::put('regionales/{regional}',[App\Http\Controllers\RegionalController::class,'update'])->name('regionales.update');
    Route::delete('regionales/{regional}',[App\Http\Controllers\RegionalController::class,'destroy'])->name('regionales.destroy');
});
