<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Usuarios
        Permission::create(['descripcion'=>'Ver lista de usuarios','name'=>'users.index','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Registrar usuarios','name'=>'users.create','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Ver reporte de usuarios','name'=>'users.show','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Editar usuarios','name'=>'users.edit','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Eliminar usuarios','name'=>'users.destroy','grupo'=>'ADMINISTRACIÓN']);

        //Roles
        Permission::create(['descripcion'=>'Ver lista de roles','name'=>'roles.index','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Ver reporte de roles','name'=>'roles.show','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Registrar roles','name'=>'roles.create','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Editar roles','name'=>'roles.edit','grupo'=>'ADMINISTRACIÓN']);
        Permission::create(['descripcion'=>'Eliminar roles','name'=>'roles.destroy','grupo'=>'ADMINISTRACIÓN']);
        
        //Aeropuertos
        Permission::create(['descripcion'=>'Ver lista de aeropuertos','name'=>'aeropuertos.index','grupo'=>'AEROPUERTOS']);
        Permission::create(['descripcion'=>'Ver reporte de aeropuertos','name'=>'aeropuertos.show','grupo'=>'AEROPUERTOS']);
        Permission::create(['descripcion'=>'Registrar aeropuertos','name'=>'aeropuertos.create','grupo'=>'AEROPUERTOS']);
        Permission::create(['descripcion'=>'Editar aeropuertos','name'=>'aeropuertos.edit','grupo'=>'AEROPUERTOS']);
        Permission::create(['descripcion'=>'Eliminar aeropuertos','name'=>'aeropuertos.destroy','grupo'=>'AEROPUERTOS']);

        //Clientes
        Permission::create(['descripcion'=>'Ver lista de clientes','name'=>'clientes.index','grupo'=>'CLIENTES']);
        Permission::create(['descripcion'=>'Ver reporte  de clientes','name'=>'clientes.show','grupo'=>'CLIENTES']);
        Permission::create(['descripcion'=>'Registrar clientes','name'=>'clientes.create','grupo'=>'CLIENTES']);
        Permission::create(['descripcion'=>'Editar clientes','name'=>'clientes.edit','grupo'=>'CLIENTES']);
        Permission::create(['descripcion'=>'Eliminar clientes','name'=>'clientes.destroy','grupo'=>'CLIENTES']);

        //Cuentas
        Permission::create(['descripcion'=>'Ver lista de cuentas','name'=>'cuentas.index','grupo'=>'CUENTAS']);
        Permission::create(['descripcion'=>'Ver reporte de cuentas','name'=>'cuentas.show','grupo'=>'CUENTAS']);
        Permission::create(['descripcion'=>'Registrar cuentas','name'=>'cuentas.create','grupo'=>'CUENTAS']);
        Permission::create(['descripcion'=>'Editar cuentas','name'=>'cuentas.edit','grupo'=>'CUENTAS']);
        Permission::create(['descripcion'=>'Eliminar cuentas','name'=>'cuentas.destroy','grupo'=>'CUENTAS']);

        //Expensas
        Permission::create(['descripcion'=>'Ver lista de expensas','name'=>'expensas.index','grupo'=>'EXPENSAS']);
        Permission::create(['descripcion'=>'Ver reporte de expensas','name'=>'expensas.show','grupo'=>'EXPENSAS']);
        Permission::create(['descripcion'=>'Registrar expensas','name'=>'expensas.create','grupo'=>'EXPENSAS']);
        Permission::create(['descripcion'=>'Editar expensas','name'=>'expensas.edit','grupo'=>'EXPENSAS']);
        Permission::create(['descripcion'=>'Eliminar expensas','name'=>'expensas.destroy','grupo'=>'EXPENSAS']);

        //Formas Pago
        Permission::create(['descripcion'=>'Ver lista de formas pago','name'=>'formaspago.index','grupo'=>'FORMAS DE PAGO']);
        Permission::create(['descripcion'=>'Ver reporte de formas pago','name'=>'formaspago.show','grupo'=>'FORMAS DE PAGO']);
        Permission::create(['descripcion'=>'Registrar formas de pago','name'=>'formaspago.create','grupo'=>'FORMAS DE PAGO']);
        Permission::create(['descripcion'=>'Editar formas pago','name'=>'formaspago.edit','grupo'=>'FORMAS DE PAGO']);
        Permission::create(['descripcion'=>'Eliminar formas de pago','name'=>'formaspago.destroy','grupo'=>'FORMAS DE PAGO']);

        //Regionales
        Permission::create(['descripcion'=>'Ver lista de regionales','name'=>'regionales.index','grupo'=>'REGIONALES']);
        Permission::create(['descripcion'=>'Ver reporte de regionales','name'=>'regionales.show','grupo'=>'REGIONALES']);
        Permission::create(['descripcion'=>'Registrar regionales','name'=>'regionales.create','grupo'=>'REGIONALES']);
        Permission::create(['descripcion'=>'Editar regionales','name'=>'regionales.edit','grupo'=>'REGIONALES']);
        Permission::create(['descripcion'=>'Eliminar regionales','name'=>'regionales.destroy','grupo'=>'REGIONALES']);

        //Rubros
        Permission::create(['descripcion'=>'Ver lista de rubros','name'=>'rubros.index','grupo'=>'RUBROS']);
        Permission::create(['descripcion'=>'Ver reporte de rubros','name'=>'rubros.show','grupo'=>'RUBROS']);
        Permission::create(['descripcion'=>'Registrar rubros','name'=>'rubros.create','grupo'=>'RUBROS']);
        Permission::create(['descripcion'=>'Editar rubros','name'=>'rubros.edit','grupo'=>'RUBROS']);
        Permission::create(['descripcion'=>'Eliminar rubros','name'=>'rubros.destroy','grupo'=>'RUBROS']);

        //Unidad de medida
        Permission::create(['descripcion'=>'Ver lista de unidades de medida','name'=>'unidadesmedida.index','grupo'=>'UNIDAD DE MEDIDA']);
        Permission::create(['descripcion'=>'Ver reporte de unidades de medida','name'=>'unidadesmedida.show','grupo'=>'UNIDAD DE MEDIDA']);
        Permission::create(['descripcion'=>'Registrar unidades de medida','name'=>'unidadesmedida.create','grupo'=>'UNIDAD DE MEDIDA']);
        Permission::create(['descripcion'=>'Editar unidades de medida','name'=>'unidadesmedida.edit','grupo'=>'UNIDAD DE MEDIDA']);
        Permission::create(['descripcion'=>'Eliminar unidades de medida','name'=>'unidadesmedida.destroy','grupo'=>'UNIDAD DE MEDIDA']);

        //Contratos
        Permission::create(['descripcion'=>'Ver lista de contratos','name'=>'contratos.index','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Registrar contratos','name'=>'contratos.create','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Editar contratos','name'=>'contratos.edit','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Eliminar contratos','name'=>'contratos.destroy','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Enviar para aprobar contrato','name'=>'contratos.send','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Registrar espacios','name'=>'contratos.create_espacio','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Editar espacios','name'=>'contratos.edit_espacio','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Eliminar espacios','name'=>'contratos.destroy_espacio','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Lista para aprobar contratos','name'=>'aprobarcontratos.index','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Aprobar contratos','name'=>'aprobarcontratos.edit','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Lista para cancelar contratos','name'=>'cancelarcontratos.index','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Cancelar contratos','name'=>'cancelarcontratos.edit','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Cancelar contrato - editar espacio','name'=>'cancelarcontratos.create_espacio','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Enviar para aprobar contrato modificado','name'=>'cancelarcontratos.send','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Lista de documentos de contratos','name'=>'documentocontratos.index','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Cargar documento de contrato','name'=>'documentocontratos.edit','grupo'=>'CONTRATOS']);
        Permission::create(['descripcion'=>'Descargar documento de contrato','name'=>'documentocontratos.descargar','grupo'=>'CONTRATOS']);

        //Garantias
        Permission::create(['descripcion'=>'Ver lista de garantias','name'=>'garantias.index','grupo'=>'GARANTIAS']);
        Permission::create(['descripcion'=>'Registrar garantias','name'=>'garantias.create','grupo'=>'GARANTIAS']);

        //Plantillas
        Permission::create(['descripcion'=>'Ver lista de plantillas','name'=>'plantillas.index','grupo'=>'PLANTILLAS']);
        Permission::create(['descripcion'=>'Registrar plantillas','name'=>'plantillas.create','grupo'=>'PLANTILLAS']);
        Permission::create(['descripcion'=>'Editar plantillas','name'=>'plantillas.edit','grupo'=>'PLANTILLAS']);
        Permission::create(['descripcion'=>'Eliminar plantillas','name'=>'plantillas.destroy','grupo'=>'PLANTILLAS']);
        Permission::create(['descripcion'=>'Visualizar plantillas','name'=>'plantillas.show','grupo'=>'PLANTILLAS']);

        //Facturación
        Permission::create(['descripcion'=>'Generar/Visualizar notas de cobro','name'=>'notacobro.index','grupo'=>'FACTURACIÓN']);
        Permission::create(['descripcion'=>'Generar nota de cobro','name'=>'notacobro.generar','grupo'=>'FACTURACIÓN']);
        Permission::create(['descripcion'=>'Visualizar nota de cobro','name'=>'notacobro.visualizar','grupo'=>'FACTURACIÓN']);
        Permission::create(['descripcion'=>'Aprobar nota de cobro','name'=>'notacobro.aprobar','grupo'=>'FACTURACIÓN']);

        Permission::create(['descripcion'=>'Ver lista notas de cobro manual','name'=>'notacobromanual.index','grupo'=>'FACTURACIÓN']);
        Permission::create(['descripcion'=>'Registrar nota de cobro manual','name'=>'notacobromanual.create','grupo'=>'FACTURACIÓN']);
        Permission::create(['descripcion'=>'Aprobar nota de cobro manual','name'=>'notacobromanual.aprobar','grupo'=>'FACTURACIÓN']);
        Permission::create(['descripcion'=>'Modificar nota de cobro manual','name'=>'notacobromanual.edit','grupo'=>'FACTURACIÓN']);
        Permission::create(['descripcion'=>'Visualizar nota de cobro manual','name'=>'notacobromanual.show','grupo'=>'FACTURACIÓN']);

        Permission::create(['descripcion'=>'Generar/Visualizar facturación notas de cobro','name'=>'facturacion.index','grupo'=>'FACTURACIÓN']);
        Permission::create(['descripcion'=>'Buscar notas de cobro/ Buscar factura generada','name'=>'facturacion.buscar','grupo'=>'FACTURACIÓN']);
        Permission::create(['descripcion'=>'Generar factura','name'=>'facturacion.generar','grupo'=>'FACTURACIÓN']);


        //Registro de Pagos
        Permission::create(['descripcion'=>'Ver lista de registro de pagos','name'=>'registropagos.index','grupo'=>'REGISTRO DE PAGOS']);
        Permission::create(['descripcion'=>'Registrar registro de pagos','name'=>'registropagos.create','grupo'=>'REGISTRO DE PAGOS']);

        //Reportes 
        Permission::create(['descripcion'=>'Ver reporte de contratos','name'=>'reportecontratos.index','grupo'=>'REPORTES']);
        Permission::create(['descripcion'=>'Ver reporte de cuentas por cobrar','name'=>'reportecuentaporcobrar.index','grupo'=>'REPORTES']);
        Permission::create(['descripcion'=>'Ver reporte de detalle de espacios','name'=>'reportedetalleespacios.index','grupo'=>'REPORTES']);
        Permission::create(['descripcion'=>'Ver reporte de facturas/notas de cobro','name'=>'reportefacturas.index','grupo'=>'REPORTES']);
        Permission::create(['descripcion'=>'Ver reporte de garantias','name'=>'reportegarantias.index','grupo'=>'REPORTES']);
        Permission::create(['descripcion'=>'Ver reporte de registro de pagos','name'=>'reporteregistropagos.index','grupo'=>'REPORTES']);
        Permission::create(['descripcion'=>'Ver reporte de tipo de espacios','name'=>'reportetipoespacios.index','grupo'=>'REPORTES']);
        Permission::create(['descripcion'=>'Ver reporte de resumén de contratos','name'=>'reporteresumencontratos.index','grupo'=>'REPORTES']);
        Permission::create(['descripcion'=>'Ver reporte de ingresos por aeropuertos','name'=>'reporteingresoaeropuertos.index','grupo'=>'REPORTES']);
        Permission::create(['descripcion'=>'Ver reporte de ingresos por clientes','name'=>'reporteingresoclientes.index','grupo'=>'REPORTES']);
        Permission::create(['descripcion'=>'Ver reporte de deudas','name'=>'reportedeudas.index','grupo'=>'REPORTES']);
        Permission::create(['descripcion'=>'Ver reporte de ingresos y deudas','name'=>'reporteingresodeudas.index','grupo'=>'REPORTES']);
        Permission::create(['descripcion'=>'Ver reporte de mora','name'=>'reportemora.index','grupo'=>'REPORTES']);
    }
}
