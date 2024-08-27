
<link rel="stylesheet" type="text/css" href="{{url('/assets/css/empleados/pdf.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
<title>File Personal</title>
<div class="margin-top">
   <h5 class="text-center">GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ</h5>
   <h6 class="text-center">FILE - PERSONAL</h6>
    <table>
        <tr>
            <td><strong>DE:</strong> {{ $empleado->ap_paterno }} {{ $empleado->ap_materno }} {{ $empleado->nombres }}</td>
        </tr>
        <tr>
            <td><strong>FECHA INGRESO</strong> {{ date('d-m-Y',strtotime($empleado->cargo[0]->pivot->fecha_inicio ))}}</td>
        </tr>
    </table>
    <hr class="hr">
    <h6>1. DOCUMENTACION PERSONAL</h6>
    <table>
        <tr>
            <td style="width: 80%;">Hoja de vida(curricular vitae) documentado</td>
            <td style="width: 20%;">@if($documentacion->hoja_vida != null) SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Fotografía 4x4 Fondo Blanco</td>
            <td style="width: 20%;">@if($documentacion->foto != null) SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Fotocopia Carnet Identidad</td>
            <td style="width: 20%;">@if($documentacion->fotocopia_carnet_identidad != null) SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Fotocopia Certificado Nacimiento</td>
            <td style="width: 20%;">@if($documentacion->fotocopia_carnet_identidad =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Fotocopia Servicio Militar(varones)</td>
            <td style="width: 20%;">@if($documentacion->fotocopia_servicio_militar =='si') SI @else NO @endif</td>
        </tr>
    </table>
    <hr class="hr">
    <h6>2. DOCUMENTACION COMPLEMENTARIA</h6>
    <table>
        <tr>
            <td style="width: 80%;">Certificado Aymara</td>
            <td style="width: 20%;">@if($documentacion->certificado_aymara != null) SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Certificado 1178 Ley Safcoo</td>
            <td style="width: 20%;">@if($documentacion->certificado_ley_safco =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Formulario Segip</td>
            <td style="width: 20%;">@if($documentacion->formulario_segip =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Cuenta Banco Union</td>
            <td style="width: 20%;">@if($documentacion->cuenta_banco_union =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">GESTORA O NUA(si corresponde)</td>
            <td style="width: 20%;">@if($documentacion->gestora =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Formulario Seguro AVC-04</td>
            <td style="width: 20%;">@if($documentacion->formulario_seguro_avc_04 != null) SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Formulario Baja Seguro AVC-07</td>
            <td style="width: 20%;">@if($documentacion->formulario_baja_seguro =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Ciudadanía Digital</td>
            <td style="width: 20%;">@if($documentacion->ciudadania_digital =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Formulario Incompatibilidad</td>
            <td style="width: 20%;">@if($documentacion->formulario_incompatibilidad =='si') SI @else NO @endif</td>
        </tr>
    </table>
    <hr class="hr">
    <h6>3. DOCUMENTACION INSTITUCIONAL PERSONAL</h6>
    <table>
        <tr>
            <td style="width: 80%;">Memorándum Designación</td>
            <td style="width: 20%;">@if($documentacion->memorandum_designacion != null) SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Otros memorándums que conciernen al Servicio Público</td>
            <td style="width: 20%;">@if($documentacion->memorandum_servidor_publico =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Memorándum (Destitución o Retiro)</td>
            <td style="width: 20%;">@if($documentacion->memorandum_destitucion =='si') SI @else NO @endif</td>
        </tr>
    </table>
    <hr class="hr">
    <h6>4. DOCUMENTACION INSTITUCIONAL</h6>
    <table>
       
        <tr>
            <td style="width: 80%;">Formulario de declaración de incompatibilidades de doble percepción</td>
            <td style="width: 20%;">@if($documentacion->formulario_incompatibilidad_percepcion =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Formulario de declaración de incompatibilidades</td>
            <td style="width: 20%;">@if($documentacion->formulario_declaracion_incompatibilidades =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Formulario de inducción</td>
            <td style="width: 20%;">@if($documentacion->formulario_induccion =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Certificado de SIPASSE y REJAP</td>
            <td style="width: 20%;">@if($documentacion->certificado_sipasse_rejap =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Calificación de años de servicio</td>
            <td style="width: 20%;">@if($documentacion->cas != null) SI @else NO @endif</td>
        </tr>
    </table>
    <hr class="hr">
    <h6>5. VACACIONES Y LICENCIAS</h6>
    <table>
        <tr>
            <td style="width: 80%;">Licencias</td>
            <td style="width: 20%;">@if($documentacion->licencias =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">vacaciones</td>
            <td style="width: 20%;">@if($documentacion->vacaciones =='si') SI @else NO @endif</td>
        </tr>
        <tr>
            <td style="width: 80%;">Lactancia</td>
            <td style="width: 20%;">@if($documentacion->lactancia =='si') SI @else NO @endif</td>
        </tr>
    </table>
</div>