
<link rel="stylesheet" type="text/css" href="<?php echo e(url('/assets/css/licencias/pdf_licencia_sin.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link id="pagestyle" href="/assets/css/argon-dashboard.css" rel="stylesheet" />

<div class="margin-top">
   <div style="border: solid 1px #4e4b4bfa; border-radius:20px;">
      <div style="padding: 12px">
         <table class="title">
            <tr class="items">
                  <td style="width: 10%; text-align:center">
                     <img src="<?php echo e(asset('assets/img/escudoGobRed.png')); ?>" width="60px" alt="Image"/>
                  </td>
                  <td style="width: 80%; text-align:center; font-size:20px; font-weight: bold;">
                     GOBIERNO AUTONOMO DEPARTAMENTAL DE LA PAZ <br>
                     DIRECCION DE RECURSOS HUMANOS
                  </td>
                  <td style="width: 10%; text-align:center"> 
                  </td>
            </tr>
         </table>
      
         <p style="font-weight: bold; text-align:center">FORMULARIO DE SOLICITUD DE PERMISO PERSONAL CON GOCE DE HABERES</p>
         <table class="body">
            <tr class="items">
                     <td style="width: 30%; text-align:center; " >
                        <fieldset class='float-label-field'>
                           <label for="txtName">Nombre del Solicitante</label>
                        </fieldset>
                     </td>
                     <td style="width: 70%; text-align:center" >
                        <fieldset class='float-label-field'>
                           <input id="txtName" type='text' value="<?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?>">
                        </fieldset>
                     </td>
            </tr>
            <tr class="items">
                <td style="width: 30%; text-align:center; " >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Nombre del Funcionario</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="<?php echo e($licenciaHaber->nombre_funcionario); ?>">
                   </fieldset>
                </td>
       </tr>
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Area Organizacional</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value=<?php echo e($licenciaHaber->area); ?>>
                  </fieldset>
               </td>
            </tr>
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Nombre Jefe Inmediato Superior</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value=<?php echo e($licenciaHaber->nombre_autoridad_o_jefe); ?>>
                  </fieldset>
               </td>
            </tr>
         </table>
   
         <br>
         <p style="font-weight: bold;">SOLICITUD DE PERMISO</p>
         <table class="body">
            <tr class="items">
                     <td style="width: 30%; text-align:center" >
                        <fieldset class='float-label-field'>
                           <label for="txtName">Desde el dia</label>
                        </fieldset>
                     </td>
                     <td style="width: 70%; text-align:center" >
                        <fieldset class='float-label-field'>
                           <input id="txtName" type='text' value="<?php echo e($licencia->fecha_inicio); ?>">
                        </fieldset>
                     </td>
            </tr>
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Hasta el dia</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value="<?php echo e($licencia->fecha_fin); ?>">
                  </fieldset>
               </td>
            </tr>
            <tr class="items">
               <td style="width: 30%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <label for="txtName">Motivo de la Solicitud</label>
                  </fieldset>
               </td>
               <td style="width: 70%; text-align:center" >
                  <fieldset class='float-label-field'>
                     <input id="txtName" type='text' value="<?php echo e($licencia->motivo); ?>">
                  </fieldset>
               </td>
            </tr>
         </table>
      
         <div style="border: solid 1px #4e4b4bfa; border-radius:20px; margin-top:20px">
            <div style="padding: 8px; font-size: 10px;">
               Reglamento Interno de Personal Art. 26 Paragrafo <br>
               (SOLICITUD EXCEPCIONAL DE PERMISO PERSONAL CON GOCE DE HABERES) <br>
             </div>
         </div>

         <br>
         <br>
         <br>
      
         <table class="body">
            <tr class="items">
               <td style="width: 5%; text-align:center">          
               </td>
            <td style="width: 30%; text-align:center" >
               <fieldset class='float-label-field-firma'>
                  <input id="txtName" type='text' value="">
                  <label for="txtName">Firma/Sello Solicitante</label>
                  </fieldset>
            </td>
            <td style="width: 30%; text-align:center" >
               <fieldset class='float-label-field-firma'>
                  <input id="txtName" type='text' value="">
                  <label for="txtName">Firma/Sello Autoridad Ejecutiva</label>
                  </fieldset>
            </td>
            <td style="width: 30%; text-align:center" >
               <fieldset class='float-label-field-firma'>
                  <input id="txtName" type='text' value="">
                  <label for="txtName">Firma/Sello DRRHH</label>
                  </fieldset>
            </td>
            <td style="width: 5%; text-align:center">    
            </td>
            </tr>
         </table>
      
         <table class="body">
            <tr class="items">
                  <td style="width: 30%; text-align:center" >
                     <fieldset class='float-label-field'>
                        <label for="txtName">La Paz,</label>
                        </fieldset>
                  </td>
                  <td style="width: 30%; text-align:center" >
                     <fieldset class='float-label-field'>
                        <input id="txtName" type='text' value="<?php echo e($licencia->fecha_registro); ?>">
                        </fieldset>
                  </td>
                  <td style="width: 40%; text-align:center" >
                  </td>
            </tr> 
         </table>
         <br>
      </div>
   </div>







   <div style="border: solid 1px #4e4b4bfa; border-radius:20px; margin-top:15px;">
      <div style="padding: 12px">
            <p style="font-weight: bold;">PARA USO DE CONTROL DE PERSONAL</p>
            <table class="body">
               <tr class="items">
                        <td style="width: 30%; text-align:center" >
                           <fieldset class='float-label-field'>
                              <label for="txtName">Nombre Solicitante</label>
                           </fieldset>
                        </td>
                        <td style="width: 70%; text-align:center" >
                           <fieldset class='float-label-field'>
                              <input id="txtName" type='text' value="<?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?>">
                           </fieldset>
                        </td>
               </tr>
               <tr class="items">
                <td style="width: 30%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <label for="txtName">Nombre Funcionario</label>
                   </fieldset>
                </td>
                <td style="width: 70%; text-align:center" >
                   <fieldset class='float-label-field'>
                      <input id="txtName" type='text' value="<?php echo e($licenciaHaber->nombre_funcionario); ?>">
                   </fieldset>
                </td>
       </tr>
               <tr class="items">
                  <td style="width: 30%; text-align:center" >
                     <fieldset class='float-label-field'>
                        <label for="txtName">Area de Trabajo</label>
                     </fieldset>
                  </td>
                  <td style="width: 70%; text-align:center" >
                     <fieldset class='float-label-field'>
                        <input id="txtName" type='text' value=<?php echo e($licenciaHaber->area); ?>>
                     </fieldset>
                  </td>
               </tr>
               <tr class="items">
                  <td style="width: 30%; text-align:center" >
                     <fieldset class='float-label-field'>
                        <label for="txtName">Motivo</label>
                     </fieldset>
                  </td>
                  <td style="width: 70%; text-align:center" >
                     <fieldset class='float-label-field'>
                        <input id="txtName" type='text' value="<?php echo e($licencia->motivo); ?>">
                     </fieldset>
                  </td>
               </tr>   
            </table>
            <br>
            <br>

            <table class="body">
               <tr class="items">
                  <td style="width: 30%; text-align:center" >
                     <fieldset class='float-label-field'>
                        <label for="txtName">Desde Fecha:</label>
                     </fieldset>
                  </td>
                  <td style="width: 25%; text-align:center" >
                     <fieldset class='float-label-field'>
                        <input id="txtName" type='text' value="<?php echo e($licencia->fecha_inicio); ?>">
                     </fieldset>
                  </td>
                  <td style="width: 20%; text-align:center" >
                     <fieldset class='float-label-field'>
                        <label for="txtName">Hasta Fecha:</label>
                     </fieldset>
                  </td>
                  <td style="width: 25%; text-align:center" >
                     <fieldset class='float-label-field'>
                        <input id="txtName" type='text' value="<?php echo e($licencia->fecha_fin); ?>">
                     </fieldset>
                  </td>
               </tr>
            </table>

            <br>
            <br>
            <table class="body">
               <tr class="items">
                  <td style="width: 30%; text-align:center" >
                     <fieldset class='float-label-field'>
                        <label for="txtName">Lugar y Fecha:</label>
                     </fieldset>
                  </td>
                  <td style="width: 70%; text-align:center" >
                     <fieldset class='float-label-field'>
                        <input id="txtName" type='text' value="La Paz, <?php echo e($licencia->fecha_registro); ?>">
                     </fieldset>
                  </td>
               </tr>
            </table>

            <br>
            <br>
            <br>

            <table class="body">
               <tr class="items">
                  <td style="width: 5%; text-align:center">          
                  </td>
                  <td style="width: 30%; text-align:center" >
                     <fieldset class='float-label-field-firma'>
                        <input id="txtName" type='text' value="">
                        <label for="txtName">Firma/Sello Solicitante</label>
                        </fieldset>
                  </td>
                  <td style="width: 30%; text-align:center" >
                     <fieldset class='float-label-field-firma'>
                        <input id="txtName" type='text' value="">
                        <label for="txtName">Firma/Sello Autoridad Ejecutiva</label>
                        </fieldset>
                  </td>
                  <td style="width: 30%; text-align:center" >
                     <fieldset class='float-label-field-firma'>
                        <input id="txtName" type='text' value="">
                        <label for="txtName">Firma/Sello DRRHH</label>
                        </fieldset>
                  </td>
                  <td style="width: 5%; text-align:center">    
                  </td>
               </tr>
            </table>
      </div>
   </div>
</div>



<?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/licencias/pdf/ficha_licencia_con_goce.blade.php ENDPATH**/ ?>