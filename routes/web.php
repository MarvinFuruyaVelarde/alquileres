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
    Route::get('cuentas',[App\Http\Controllers\CuentaController::class,'index'])->name('cuentas.index')->middleware('permission:cuentas.index');
    Route::get('cuentas/create',[App\Http\Controllers\CuentaController::class,'create'])->name('cuentas.create')->middleware('permission:cuentas.create');
    Route::post('cuentas/store',[App\Http\Controllers\CuentaController::class,'store'])->name('cuentas.store')->middleware('permission:cuentas.create');
    Route::get('cuentas/{cuenta}/edit',[App\Http\Controllers\CuentaController::class,'edit'])->name('cuentas.edit')->middleware('permission:cuentas.edit');
    Route::put('cuentas/{cuenta}',[App\Http\Controllers\CuentaController::class,'update'])->name('cuentas.update')->middleware('permission:cuentas.edit');
    Route::delete('cuentas/{cuenta}',[App\Http\Controllers\CuentaController::class,'destroy'])->name('cuentas.destroy')->middleware('permission:cuentas.destroy');
    Route::get('cuentas/pdf',[App\Http\Controllers\CuentaController::class,'show'])->name('cuentas.show')->middleware('permission:cuentas.show');
    Route::get('cuentas/xls',[App\Http\Controllers\CuentaController::class,'export'])->name('cuentas.export')->middleware('permission:cuentas.show');
    
    //unidad de medida
    Route::get('unidadesmedida',[App\Http\Controllers\UnidadMedidaController::class,'index'])->name('unidadesmedida.index')->middleware('permission:unidadesmedida.index');
    Route::get('unidadesmedida/create',[App\Http\Controllers\UnidadMedidaController::class,'create'])->name('unidadesmedida.create')->middleware('permission:unidadesmedida.create');
    Route::post('unidadesmedida/store',[App\Http\Controllers\UnidadMedidaController::class,'store'])->name('unidadesmedida.store')->middleware('permission:unidadesmedida.create');
    Route::get('unidadesmedida/{unidadmedida}/edit',[App\Http\Controllers\UnidadMedidaController::class,'edit'])->name('unidadesmedida.edit')->middleware('permission:unidadesmedida.edit');
    Route::put('unidadesmedida/{unidadmedida}',[App\Http\Controllers\UnidadMedidaController::class,'update'])->name('unidadesmedida.update')->middleware('permission:unidadesmedida.edit');
    Route::delete('unidadesmedida/{unidadmedida}',[App\Http\Controllers\UnidadMedidaController::class,'destroy'])->name('unidadesmedida.destroy')->middleware('permission:unidadesmedida.destroy');
    Route::get('unidadesmedida/pdf',[App\Http\Controllers\UnidadMedidaController::class,'show'])->name('unidadesmedida.show')->middleware('permission:unidadesmedida.show');
    Route::get('unidadesmedida/xls',[App\Http\Controllers\UnidadMedidaController::class,'export'])->name('unidadesmedida.export')->middleware('permission:unidadesmedida.show');

    //contratos
    //lista
    Route::get('contratos',[App\Http\Controllers\ContratoController::class,'index'])->name('contratos.index')->middleware('permission:contratos.index');
    Route::get('contratos/obtCliente/{tipoSolicitante}',[App\Http\Controllers\ContratoController::class,'obtieneCliente'])->name('contratos.obtieneCliente');
    Route::get('contratos/create',[App\Http\Controllers\ContratoController::class,'create'])->name('contratos.create')->middleware('permission:contratos.create');
    Route::post('contratos/store',[App\Http\Controllers\ContratoController::class,'store'])->name('contratos.store')->middleware('permission:contratos.create');
    Route::get('contratos/{contrato}/edit',[App\Http\Controllers\ContratoController::class,'edit'])->name('contratos.edit')->middleware('permission:contratos.edit');
    Route::put('contratos/{contrato}',[App\Http\Controllers\ContratoController::class,'update'])->name('contratos.update')->middleware('permission:contratos.edit');
    Route::delete('contratos/{contrato}',[App\Http\Controllers\ContratoController::class,'destroy'])->name('contratos.destroy')->middleware('permission:contratos.destroy');
    Route::put('contratos/{contrato}/send',[App\Http\Controllers\ContratoController::class,'send'])->name('contratos.send')->middleware('permission:contratos.send');


    Route::get('contratos/espacios/{contrato}',[App\Http\Controllers\ContratoController::class,'createEspacio'])->name('contratos.create_espacio')->middleware('permission:contratos.create_espacio');
    Route::post('contratos/espacios/store',[App\Http\Controllers\ContratoController::class,'storeEspacio'])->name('contratos.store_espacio')->middleware('permission:contratos.create_espacio');
    Route::get('contratos/espacios/{contrato}/{espacio}/edit',[App\Http\Controllers\ContratoController::class,'editEspacio'])->name('contratos.edit_espacio')->middleware('permission:contratos.edit_espacio');
    Route::put('contratos/espacios/{espacio}',[App\Http\Controllers\ContratoController::class,'updateEspacio'])->name('contratos.update_espacio')->middleware('permission:contratos.edit_espacio');
    Route::delete('contratos/espacios/eliminar/{espacio}',[App\Http\Controllers\ContratoController::class,'destroyEspacio'])->name('contratos.destroy_espacio')->middleware('permission:contratos.destroy_espacio');

    Route::get('aprobarcontratos',[App\Http\Controllers\AprobarContratoController::class,'index'])->name('aprobarcontratos.index')->middleware('permission:aprobarcontratos.index');
    Route::get('aprobarcontratos/{contrato}/edit',[App\Http\Controllers\AprobarContratoController::class,'edit'])->name('aprobarcontratos.edit')->middleware('permission:aprobarcontratos.edit');
    Route::put('aprobarcontratos/{contrato}',[App\Http\Controllers\AprobarContratoController::class,'update'])->name('aprobarcontratos.update')->middleware('permission:aprobarcontratos.edit');

    Route::get('cancelarcontratos',[App\Http\Controllers\CancelarContratoController::class,'index'])->name('cancelarcontratos.index')->middleware('permission:cancelarcontratos.index');
    Route::get('cancelarcontratos/{contrato}/edit',[App\Http\Controllers\CancelarContratoController::class,'edit'])->name('cancelarcontratos.edit')->middleware('permission:cancelarcontratos.edit');
    Route::put('cancelarcontratos/{contrato}',[App\Http\Controllers\CancelarContratoController::class,'update'])->name('cancelarcontratos.update')->middleware('permission:cancelarcontratos.edit');
    Route::get('cancelarcontratos/espacios/{contrato}',[App\Http\Controllers\CancelarContratoController::class,'createEspacio'])->name('cancelarcontratos.create_espacio')->middleware('permission:cancelarcontratos.create_espacio');
    Route::post('cancelarcontratos/espacios/store',[App\Http\Controllers\CancelarContratoController::class,'storeEspacio'])->name('cancelarcontratos.store_espacio')->middleware('permission:cancelarcontratos.create_espacio');
    Route::get('cancelarcontratos/espacios/{contrato}/{espacio}/edit',[App\Http\Controllers\CancelarContratoController::class,'editEspacio'])->name('cancelarcontratos.edit_espacio')->middleware('permission:cancelarcontratos.create_espacio');
    Route::put('cancelarcontratos/espacios/{espacio}',[App\Http\Controllers\CancelarContratoController::class,'updateEspacio'])->name('cancelarcontratos.update_espacio')->middleware('permission:cancelarcontratos.create_espacio');
    Route::put('cancelarcontratos/{contrato}/send',[App\Http\Controllers\CancelarContratoController::class,'send'])->name('cancelarcontratos.send')->middleware('permission:cancelarcontratos.send');
    

    Route::get('documentocontratos',[App\Http\Controllers\DocumentoContratoController::class,'index'])->name('documentocontratos.index')->middleware('permission:documentocontratos.index');
    Route::get('documentocontratos/{contrato}/edit',[App\Http\Controllers\DocumentoContratoController::class,'edit'])->name('documentocontratos.edit')->middleware('permission:documentocontratos.edit');
    Route::put('documentocontratos/{contrato}',[App\Http\Controllers\DocumentoContratoController::class,'update'])->name('documentocontratos.update')->middleware('permission:documentocontratos.edit');

    //garantia
    Route::get('garantias',[App\Http\Controllers\GarantiaController::class,'index'])->name('garantias.index')->middleware('permission:garantias.index');
    Route::get('garantias/{contrato}/create',[App\Http\Controllers\GarantiaController::class,'create'])->name('garantias.create')->middleware('permission:garantias.create');
    Route::post('garantias/store',[App\Http\Controllers\GarantiaController::class,'store'])->name('garantias.store')->middleware('permission:garantias.create');

    //Plantilla
    Route::get('plantilla',[App\Http\Controllers\PlantillaController::class,'index'])->name('plantillas.index')->middleware('permission:plantillas.index');
    Route::get('plantilla/create',[App\Http\Controllers\PlantillaController::class,'create'])->name('plantillas.create')->middleware('permission:plantillas.create');
    Route::post('plantilla/store',[App\Http\Controllers\PlantillaController::class,'store'])->name('plantillas.store')->middleware('permission:plantillas.create');
    Route::get('plantilla/{id}/edit',[App\Http\Controllers\PlantillaController::class,'edit'])->name('plantillas.edit')->middleware('permission:plantillas.edit');
    Route::post('plantilla/update/{contrato}',[App\Http\Controllers\PlantillaController::class,'update'])->name('plantillas.update')->middleware('permission:plantillas.edit');
    Route::delete('plantilla/{id}',[App\Http\Controllers\PlantillaController::class,'destroy'])->name('plantillas.destroy')->middleware('permission:plantillas.destroy');
    Route::get('plantilla/pdf/{id}',[App\Http\Controllers\PlantillaController::class,'show'])->name('plantillas.show')->middleware('permission:plantillas.show');
    Route::get('api/plantilla/{cliente}/{contrato}',[App\Http\Controllers\PlantillaController::class,'ajax'])->name('plantillas.ajax');
    Route::get('api/plantilla1/{contrato}',[App\Http\Controllers\PlantillaController::class,'ajax1'])->name('plantillas1.ajax');

    //Facturación
    Route::get('notacobro',[App\Http\Controllers\NotaCobroController::class,'index'])->name('notacobro.index');
    Route::get('notacobro/generar',[App\Http\Controllers\NotaCobroController::class,'generaNotaCobro'])->name('notacobro.generaNotaCobro');
    Route::get('notacobro/obt_cliente/{aeropuerto}/{cliente}',[App\Http\Controllers\NotaCobroController::class,'obtieneCliente'])->name('notacobro.obtieneCliente');
    Route::get('notacobro/visualizar',[App\Http\Controllers\NotaCobroController::class,'visualizaNotaCobro'])->name('notacobro.visualizaNotaCobro');
    Route::post('notacobro/aprobar',[App\Http\Controllers\NotaCobroController::class,'aprobarNotaCobro'])->name('notacobro.aprobarNotaCobro');
    Route::get('notacobro/edit/{id}',[App\Http\Controllers\NotaCobroController::class,'edit'])->name('notacobro.edit');
    Route::put('notacobro/update/{id}/',[App\Http\Controllers\NotaCobroController::class,'update'])->name('notacobro.update');
    Route::get('notacobro/pdf/{id}',[App\Http\Controllers\NotaCobroController::class,'show'])->name('notacobro.show');

    Route::get('notacobromanual',[App\Http\Controllers\NotaCobroManualController::class,'index'])->name('notacobromanual.index');
    Route::get('notacobromanual/obt_cliente/{aeropuerto}/{cliente}',[App\Http\Controllers\NotaCobroManualController::class,'obtieneCliente'])->name('notacobromanual.obtieneCliente');
    Route::get('notacobromanual/obtCodigoContrato/{aeropuerto}/{cliente}',[App\Http\Controllers\NotaCobroManualController::class,'obtieneCodigoContrato'])->name('notacobromanual.obtieneCodigoContrato');
    Route::get('notacobromanual/obtieneExpensa',[App\Http\Controllers\NotaCobroManualController::class, 'obtieneExpensa'])->name('notacobromanual.obtieneExpensa');
    Route::get('notacobromanual/obtieneEspacioCanonVariable',[App\Http\Controllers\NotaCobroManualController::class, 'obtieneEspacioCanonVariable'])->name('notacobromanual.obtieneEspacioCanonVariable');
    Route::get('notacobromanual/create',[App\Http\Controllers\NotaCobroManualController::class,'create'])->name('notacobromanual.create');
    Route::post('notacobromanual/store',[App\Http\Controllers\NotaCobroManualController::class,'store'])->name('notacobromanual.store');
    Route::get('notacobromanual/{notacobromanual}/edit',[App\Http\Controllers\NotaCobroManualController::class,'edit'])->name('notacobromanual.edit');
    Route::put('notacobromanual/{idFactura}',[App\Http\Controllers\NotaCobroManualController::class,'update'])->name('notacobromanual.update');
    Route::post('notacobromanual/aprobar',[App\Http\Controllers\NotaCobroManualController::class,'aprobarNotaCobroManual'])->name('notacobromanual.aprobarNotaCobroManual');
    Route::get('notacobromanual/pdf/{id}',[App\Http\Controllers\NotaCobroManualController::class,'show'])->name('notacobromanual.show');
    

    Route::get('facturacion',[App\Http\Controllers\FacturaController::class,'index'])->name('facturacion.index');
    Route::get('facturacion/buscaNotaCobroPendiente',[App\Http\Controllers\FacturaController::class,'buscaNotaCobroPendiente'])->name('facturacion.buscaNotaCobroPendiente');
    Route::post('facturacion/generarfactura',[App\Http\Controllers\FacturaController::class,'generarFactura'])->name('facturacion.generarFactura');
    Route::get('facturacion/buscaNotaCobroGenerada',[App\Http\Controllers\FacturaController::class,'buscaNotaCobroGenerada'])->name('facturacion.buscaNotaCobroGenerada');
    Route::get('facturacion/pdf/{id}',[App\Http\Controllers\NotaCobroController::class,'show'])->name('facturacion.show');
    Route::get('facturacion/imprimir/{id}',[App\Http\Controllers\FacturaController::class,'imprimir'])->name('facturacion.imprimir');
    Route::get('facturacion/anular/{id}',[App\Http\Controllers\FacturaController::class,'anular'])->name('facturacion.anular');

    //Registro de Pagos
    Route::get('registropagos',[App\Http\Controllers\DetallePagoFacturaController::class,'index'])->name('registropagos.index');
    Route::get('registropagos/{factura}/create',[App\Http\Controllers\DetallePagoFacturaController::class,'create'])->name('registropagos.create');
    Route::post('registropagos/store',[App\Http\Controllers\DetallePagoFacturaController::class,'store'])->name('registropagos.store');
});
