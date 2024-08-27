<link rel="stylesheet" type="text/css" href="{{url('/assets/css/empleados/pdf.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />
<title>Ficha Personal</title>
<div class="margin-top">
   <table class="title">
      <tr class="items">
              <td style="width: 20%; text-align:center">
                 <img src="{{asset('assets/img/escudoGobRed.png')}}" width="60px" alt="Image"/>
              </td>
              <td style="width: 60%; text-align:center; font-size:20px; font-weight: bold;">
                 DIRECCIÓN DE RECURSOS HUMANOS <br>
                 FILE - PERSONAL <br>
                 {{ $empleado->cargo[0]->pivot['cargos.tipo_cargo'] }}
              </td>
              <td style="width: 20%; text-align:center">
                  <img src="{{ asset('fotos_empleados/'.$empleado->id.'/'.$empleado->foto) }}" height="100px;">
              </td>
      </tr>
  </table>

  <p style="font-weight: bold">I. DATOS PERSONALES</p>
   <table class="body">
       <tr class="items" style="width: 100%">
               <td style="width: 33.3%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName" >Nombres</label>
                     <input id="txtName" class="campo" type='text' value="{{ $empleado->nombres }}">
                   </fieldset>
               </td>
               <td style="width: 33.3%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Apellido Paterno</label>
                     <input id="txtName" type='text' class="campo" value="{{ $empleado->ap_paterno }}">
                   </fieldset>
               </td>
               <td style="width: 33.3%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Apellido Materno</label>
                     <input id="txtName" type='text' class="campo" value="{{ $empleado->ap_materno }}">
                   </fieldset>
               </td>
       </tr>
   </table>
   <table class="body">
      <tr class="items" style="width:100%">
        <td style="width: 40%; text-align:center" >
           <fieldset class='float-label-field'>
              <label for="txtName">Fecha de Nacimiento</label>
              <input id="txtName" type='text' class="campo" value="{{ date('d-m-Y', strtotime($empleado->fecha_nacimiento)) }}">
            </fieldset>
        </td>
        <td style="width: 20%; text-align:center" >
           <fieldset class='float-label-field'>
              <label for="txtName">Edad</label>
              <input id="txtName" type='text' class="campo" value="{{ $empleado->edad }}">
            </fieldset>
        </td>
        <td style="width: 20%; text-align:center" >
           <fieldset class='float-label-field'>
              <label for="txtName">Estado Civil</label>
              <input id="txtName" type='text' class="campo" value="{{ $empleado->estado_civil }}">
            </fieldset>
        </td>
        <td style="width: 20%; text-align:center" >
           <fieldset class='float-label-field'>
              <label for="txtName">Nro. de Hijos</label>
              <input id="txtName" type='text' class="campo" value="{{ $empleado->nro_hijos }}">
            </fieldset>
        </td>
      </tr>
  </table>
  <table class="body">

      <tr class="items" style="width:100%">
         <td style="width: 33.3%; text-align:center" >
            <fieldset class='float-label-field'>
               <label for="txtName">Lugar de Nacimiento</label>
               <input id="txtName" type='text' class="campo" value="{{ $ciudad->ciudad }}">
            </fieldset>
         </td>
         <td style="width: 33.3%; text-align:center" >
            <fieldset class='float-label-field'>
               <label for="txtName">Provincia</label>
               <input id="txtName" type='text' class="campo" value="{{ $ciudad->provincia }}">
            </fieldset>
         </td>
         <td style="width: 33.3%; text-align:center" >
            <fieldset class='float-label-field'>
               <label for="txtName">Cédula de Identidad</label>
               <input id="txtName" type='text' class="campo" value="{{ $empleado->ci }} {{ $empleado->ci_complemento }} {{ $empleado->ci_lugar }}">
            </fieldset>
         </td>
      </tr>
   </table>

<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 60%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Domicilio</label>
           <input id="txtName" type='text' class="campo" value="{{ $empleado->domicilio }}">
         </fieldset>
     </td>
     <td style="width: 40%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Nro. de Libreta de Servicio Militar</label>
           <input id="txtName" type='text' class="campo" value="{{ $empleado->nro_libreta_militar }}">
         </fieldset>
     </td>
   </tr>
</table>

<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 60%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Correo</label>
           <input id="txtName" type='text' class="campo" value="{{ $empleado->email }}">
         </fieldset>
     </td>
     <td style="width: 20%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Celular</label>
           <input id="txtName" type='text' class="campo" value="{{ $empleado->nro_celular }}">
         </fieldset>
     </td>
     <td style="width: 20%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Teléfono</label>
           <input id="txtName" type='text' class="campo" value="{{ $empleado->nro_telefono }}">
         </fieldset>
     </td>
   </tr>
</table>
<table class="body">
   <tr class="items" style="width:100%">
        <td style="width: 60%; text-align:center" >
            <fieldset class='float-label-field'>
            <label for="txtName">Cuenta de Facebook o Instagram</label>
            <input id="txtName" type='text' class="campo" value="{{ $empleado->redes_sociales }}">
            </fieldset>
        </td>
        <td style="width: 40%; text-align:center"></td>
   </tr>
</table>

<p style="font-size: 15px">PERSONA DE CONTACTO EN CASO DE EMERGENCIA</p>
<table class="body">
   
   <tr class="items" style="width:100%">
      <td style="width: 33.3%; text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">Nombre</label>
            <input id="txtName" type='text' class="campo" value="{{ $empleado->contacto_nombre }}">
            </fieldset>
      </td>
      <td style="width: 33.3%; text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">Teléfono</label>
            <input id="txtName" type='text' class="campo" value="{{ $empleado->contacto_telefono }}">
            </fieldset>
      </td>
      <td style="width: 33.3%; text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">Parentesco</label>
            <input id="txtName" type='text' class="campo" value="{{ $empleado->contacto_parentesco }}">
            </fieldset>
      </td>
   </tr>
</table>


<p style="font-weight: bold">II. OCUPACIÓN</p>
<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 33.3%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Formación</label>
           <input id="txtName" type='text' class="campo" value="{{ $formacion->descripcion }}">
         </fieldset>
     </td>
     <td style="width: 33.3%; text-align:center" >
      <fieldset class='float-label-field'>
         <label for="txtName">Carrera Universitaria</label>
         <input id="txtName" type='text' class="campo" value="{{ $profesion->descripcion }}">
       </fieldset>
   </td>
  
   </tr>
</table>
<table class="body">
   <tr class="items" style="width:100%">
      <td style="width: 50%; text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">Universidad o Instituto</label>
            <input id="txtName" type='text' class="campo" value="{{ $institucion_educativa->descripcion }}">
          </fieldset>
      </td>
      <td style="width: 50%; text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">Ultimo empleo</label>
            <input id="txtName" type='text' class="campo" value="{{ $empleado->ultimo_empleo }}">
          </fieldset>
      </td>
    
   </tr>
</table>


<p style="font-weight: bold">III. INSTITUCIONAL</p>
<table class="body">
   <tr class="items" style="width:100%">
     <td style="text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Fecha de Ingreso</label>
           <input id="txtName" type='text' class="campo" value="{{ date('d-m-Y', strtotime($cargo[0]->fecha_inicio)) }}">
         </fieldset>
     </td>
     <td style="text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Fecha de Conclusión</label>
           <input id="txtName" type='text' class="campo" value="@if($cargo[0]->fecha_conclusion!=null){{ date('d-m-Y', strtotime($cargo[0]->fecha_conclusion)) }} @endif" >
         </fieldset>
     </td>
     <td style="text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Puesto</label>
           <input id="txtName" type='text' class="campo" value="{{ $empleado->cargo[0]->nombre }}">
         </fieldset>
     </td>
     @if($empleado->cargo[0]->tipo_cargo=='CONSULTOR')
     <td style="text-align:center" >
         <fieldset class='float-label-field'>
            <label for="txtName">NIT</label>
            <input id="txtName" type='text' class="campo" value="{{ $empleado->nit }}">
         </fieldset>
      </td>
     @endif
   </tr>
</table>

<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 40%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Número de Cuenta</label>
           <input id="txtName" type='text' class="campo" value="{{ $empleado->nro_cuenta }}">
         </fieldset>
     </td>
     <td style="width: 20%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Institución Bancaria</label>
           <input id="txtName" type='text' class="campo" value="{{ $banco->descripcion }}">
         </fieldset>
     </td>
     <td style="width: 40%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Seguro a Largo Plazo AFP:</label>
           <input id="txtName" type='text' class="campo" value="{{ $afp->descripcion }}">
         </fieldset>
     </td>
   </tr>
</table>

<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 40%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Seguro de Salud</label>
           <input id="txtName" type='text' class="campo" value="{{ $seguro_salud->descripcion }}">
         </fieldset>
     </td>
      @php
     $fecha_ingreso=date('Y-m-d', strtotime($cargo[0]->fecha_inicio));
     $date1 = new DateTime($fecha_ingreso);
     $date2 = new DateTime("now");
     $diff = $date1->diff($date2);
     @endphp
     <td style="width: 20%; text-align:center" >
        <fieldset class='float-label-field'>
           <label for="txtName">Años de Servicio </label>
           {{-- <input id="txtName" type='text' class="campo" value="@if(count($años_servicio)>0){{ $empleado->años_servicio }} @endif"> --}}
           <input id="txtName" type='text' class="campo" value="{{$diff->format('%y Años %m Meses %d Dias')}} ">
         </fieldset>
     </td>
     @if($empleado->nit === NULL)
     <td style="width: 40%; text-align:center" >

     </td>
     @else
     <td style="width: 40%; text-align:center" >
      <fieldset class='float-label-field'>
         <label for="txtName">Nit </label>
         {{-- <input id="txtName" type='text' class="campo" value="@if(count($años_servicio)>0){{ $empleado->años_servicio }} @endif"> --}}
         <input id="txtName" type='text' class="campo" value="{{$empleado->nit}} ">
       </fieldset>

     </td>


     @endif
    
   </tr>
</table>

<table class="body">
   <tr class="items">
        <td style="width: 25%; text-align:center">
        </td>
        <td style="width: 50%; height: 70px; text-align:center; font-size:20px; font-weight: bold;">
            <div style="padding: 0.5px; border: 1px solid black; height: 65px;">

            </div>
        </td>
        <td style="width: 25%; text-align:center">
        <fieldset class='float-label-field'>
            <label for="txtName">Fecha:</label>
            <input id="txtName" type='text' class="campo" value="{{ date('d-m-Y',strtotime($empleado->fecha_registro)) }}">
            </fieldset>
        </td>
   </tr>
</table>
<table class="body">
   <tr class="items" style="width:100%">
     <td style="width: 25%;" >

     </td>
     <td style="width: 50%; text-align:center; font-weight: bold;" >
        <p>FIRMA DEL FUNCIONARIO</p>
     </td>
     <td style="width: 25%;" >

     </td>
   </tr>
</table>
</div>