
@extends('layouts.app')
@section('titulo','Nuevo Usuario')
@section('content')

<div class="pagetitle">
    <h1>PLANTILLA
    </h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('plantillas.index') }}">Plantilla</a></li>
        <li class="breadcrumb-item active">Nueva Plantilla</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Nueva Plantilla</h5>
           <!--CONTENIDO -->
           {!! Form::open(['route'=>'plantillas.store','class'=>'form-horizontal','id'=>'form_reg_plantilla','data-form-id'=>'form_reg_plantilla']) !!}
                @include('plantilla._form',['texto' => 'Guardar','color'=>'primary'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/forms/validarcampos.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $("#cliente").change(function(event) {
        
      getContrato($(this).val());
    });
    function getContrato(cliente, contrato=null) {
        
      var zone = $("#contrato");
      
      $.ajax({
        url: '{{ url("api/plantilla/") }}/'+cliente+'/'+contrato,
        method: 'get',
        data: {'cliente':cliente},
        beforeSend: function(){
          zone.attr('disabled', true);
        },
        success: function (response) {
          zone.attr('disabled', false).html(response.item);
        },
       
      });
    }
  </script>
  <script type="text/javascript">
    $("#contrato").change(function(event) {
        
      getEspacio($(this).val());
    });
    function getEspacio(contrato) {
      var tabla=$("#tabla");
     
      $.ajax({
        url: '{{ url("api/plantilla1/") }}/'+contrato,
        method: 'get',
        data: {'contrato':contrato},
        success: function (response) {
          tabla.html(response.item1);  
        },
       
      });
    }
  </script>
  
@endsection
