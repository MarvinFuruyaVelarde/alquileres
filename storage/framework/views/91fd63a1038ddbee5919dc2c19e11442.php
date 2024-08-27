

<?php $__env->startSection('titulo','Documentacion'); ?>

<?php $__env->startSection('content'); ?>

<div class="pagetitle">
    <h1>Documentación Empleado</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('documentos.index')); ?>">Ver todos</a></li>
        <li class="breadcrumb-item active">Documentación</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">CONTROL DE RECEPCIÓN DE DOCUMENTOS</h5>
           <!--CONTENIDO -->
           <div class="row">
            <div class="col-md-12">
                <div class="">
                    <h6 class="text-right"><?php echo e($empleado->nombres); ?> <?php echo e($empleado->ap_paterno); ?> <?php echo e($empleado->ap_materno); ?></h6>
                    <p>Se deben completar la información marcada con <strong class="text-danger">(*)</strong></p>
                    <form action="<?php echo e(route('documentos.store')); ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="empleado_id" id="empleado_id" value="<?php echo e($empleado->id); ?>">
                        <input type="hidden" name="ci" id="ci" value="<?php echo e($empleado->ci); ?>">
                        <?php echo e(csrf_field()); ?>

                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">DOCUMENTACIÓN PERSONAL</p>
                        <div class="row justify-content-center" >
                            <div class="col-md-8 .bg-danger">
                                    <div class="form-group d-flex">
                                        <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Hoja de vida(curricular vitae) documentado</label> <span class="text-danger">(*)</span>
                                        </div>
                                        <div class="col-md-4">
                                        <input type="file" name="hoja_vida" id="" required  accept="application/pdf">
                                    </div>
                            </div>
                        </div>
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label" >Fotografía 4x4 Fondo Blanco</label> <span class="text-danger">(*)</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="foto" id="" required accept="image/png, image/gif, image/jpeg">
                                    </div>
                                </div>
                            </div>
                          
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Fotocopia Carnet Identidad</label> <span class="text-danger">(*)</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="fotocopia_carnet_identidad" id="" required  accept="application/pdf">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Fotocopia Certificado Nacimiento</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="fotocopia_certificado_nacimiento" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="fotocopia_certificado_nacimiento" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                          </div>             
                                    </div>
                                </div>
                            </div>
                       
                            
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Fotocopia Servicio Militar(varones)</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="fotocopia_servicio_militar" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="fotocopia_servicio_militar" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                            <p class="text-uppercase text-sm">DOCUMENTACIÓN COMPLEMENTARIA</p>
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label" accept="application/pdf">Certificado Aymara</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="certificado_aymara"  id="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Certificado 1178 Ley Safco</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="certificado_ley_safco" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="certificado_ley_safco" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Formulario Segip</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="formulario_segip" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="formulario_segip" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Cuenta Banco Union</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="cuenta_banco_union" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="cuenta_banco_union" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">GESTORA O NUA(si corresponde)</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="gestora" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="gestora" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label" accept="application/pdf">Formulario Seguro AVC-04</label> <span class="text-danger">(*)</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="formulario_seguro_avc_04" id="" required>
                                    </div>
                                </div>
                            </div>
                         
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Formulario Baja Seguro AVC-07</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="formulario_baja_seguro" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="formulario_baja_seguro" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Ciudadanía Digital</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="ciudadania_digital" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="ciudadania_digital" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Formulario Incompatibilidad</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="formulario_incompatibilidad" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="formulario_incompatibilidad" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-uppercase text-sm">DOCUMENTACIÓN INSTITUCIONAL PERSONAL</p>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Memorándum Designación</label> <span class="text-danger">(*)</span>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="memorandum_designacion" id="" required  accept="application/pdf">
                                  
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Otros memorándums que conciernen al Servicio Público</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="memorandum_servidor_publico" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="memorandum_servidor_publico" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Memorándum (Destitución o Retiro)</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="memorandum_destitucion" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="memorandum_destitucion" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="text-uppercase text-sm">DOCUMENTACIÓN INSTITUCIONAL</p>


                         
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Formulario de declaración de incompatibilidades de doble percepción</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="formulario_incompatibilidad_percepcion" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="formulario_incompatibilidad_percepcion" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Formulario de declaración de incompatibilidades</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="formulario_declaracion_incompatibilidades" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="formulario_declaracion_incompatibilidades" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Formulario de inducción</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="formulario_induccion" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="formulario_induccion" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Certificado de SIPASSE y REJAP</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="certificado_sipasse_rejap" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="certificado_sipasse_rejap" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Calificación de años de servicio</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="file" name="cas" id="" accept="application/pdf">
                                    </div>
                                </div>
                            </div>



                            <p class="text-uppercase text-sm">VACACIONES Y LICENCIAS</p>
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Licencias</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="licencias" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="licencias" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Vacaciones</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="vacaciones" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="vacaciones" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group d-flex">
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Lactancia</label>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio1" name="lactancia" value="no" checked>NO
                                              <label class="form-check-label" for="radio1"></label>
                                            </div>
                                            <div class="form-check d-block">
                                              <input type="radio" class="form-check-input" id="radio2" name="lactancia" value="si">SI
                                              <label class="form-check-label" for="radio2"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                 
                            
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
               
                        
                        
                       
                    </div>
                </div>
            </div>
        
        </div>
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home4/gadlprrhh/public_html/sistema_rrhh/resources/views/documentacion/create.blade.php ENDPATH**/ ?>