@extends('layouts.app')
@section('titulo','Editar Usuario')
@section('content')

<div class="pagetitle">
    <h1>Contratos</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Modificar Datos</li>
      </ol>
    </nav>
 </div><!-- End Page Title -->
 <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Modificar datos de contrato</h5>
           <!--CONTENIDO -->
           {!! Form::model($contrato,['route'=>['contratos.update',$contrato->id],'method'=>'PUT', 'id'=>'form_edit_contrato','data-form-id'=>'form_edit_contrato']) !!}
                @include('contratos.lista._form_edit',['texto' => 'Actualizar','color'=>'success'])
            {!! Form::close() !!}
            <!-- EndCONTENIDO Example -->
          </div>
        </div>
      </div>
    </div>
</section>

@endsection

@section('scripts')
{{--<script src="{{ asset('assets/js/forms/validarcampos.js') }}" type="text/javascript"></script>--}}
<script>
  var contratosObtClienteUrl = "{{ url('contratos/obtCliente/') }}";
  var verificaCodigoContrato = "{{ url('contratos/verificaCodigoContrato/') }}";
</script>
<script src="{{ asset('assets/js/forms/contratos.js') }}" type="text/javascript"></script>
<script>

  var cont = 2;

  // en caso de que sea nulo formateamos los valores
  var numeroDocumento2 = {!! json_encode($contrato->numero_documento2) !!};
  var numeroDocumento3 = {!! json_encode($contrato->numero_documento3) !!};

  //Verificamos si se debe desplegar el representante 2 y 3
  if (numeroDocumento2 !== null && numeroDocumento2 !== '') {
    document.getElementById('row-2').style.display = 'block';
    cont++;
  } 

  if (numeroDocumento3 !== null && numeroDocumento3 !== '') {
    document.getElementById('row-3').style.display = 'block';
    cont++;
  }

  // Agregar Representante 
  function agregarRepresentante() {
    var tipoSolicitante = document.getElementById('tipo_solicitante').value;
    if (cont<=3) {
      if(tipoSolicitante === '2'){
        var content = 
        '<div id="row-'+cont+'">'+
          '<div class="row mb-1">'+
            '<div class="col-md-5">'+
                '{{Form::label("representante'+cont+'",'Representante')}} <span class="text-danger">(*)</span>'+
                '<input id="representante'+cont+'" type="text" class="form-control {{ $errors->has("representante'+cont+'") ? ' error' : '' }}" name="representante'+cont+'" value="" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">'+
                '<span id="error-representante'+cont+'" class="error-representante'+cont+'" style="color: rgb(220, 53, 69);"></span>'+
                '@if ($errors->has('representante1'))'+
                    '<span class="text-danger">'+
                        '{{ $errors->first('representante1') }}'+
                    '</span>'+
                '@endif'+
            '</div>'+
            '<div class="col-md-3">'+
                '{{Form::label("numero_documento'+cont+'",'Número De Documento')}} <span class="text-danger">(*)</span>'+
                '<input id="numero_documento'+cont+'" type="text" class="form-control {{ $errors->has('numero_documento1') ? ' error' : '' }}" name="numero_documento'+cont+'" value="" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">'+
                '<span id="error-numero_documento'+cont+'" class="error-numero_documento'+cont+'" style="color: rgb(220, 53, 69);"></span>'+
                '@if ($errors->has('numero_documento1'))'+
                    '<span class="text-danger">'+
                        '{{ $errors->first('numero_documento1') }}'+
                    '</span>'+
                '@endif'+
            '</div>'+
            '<div class="col-md-3">'+
                '{{Form::label("expedido'+cont+'",'Expedido en')}}'+
                '<select id="expedido'+cont+'" class="form-control{{ $errors->has('expedido1') ? ' error' : '' }}" name="expedido'+cont+'">'+
                    '<option value="">Seleccionar...</option>'+
                    '@foreach($expedidos as $expedido)'+
                        '<option value="{{ $expedido->id }}"'+ 
                            '{{ "$contrato->expedido'+cont'" == $expedido->id ? 'selected' : '' }}>'+
                            '{{ $expedido->descripcion }}'+
                        '</option>'+
                    '@endforeach'+
                '</select>'+
                '@if ($errors->has('expedido'))'+
                    '<span class="text-danger">'+
                        '{{ $errors->first('expedido') }}'+
                    '</span>'+
                '@endif'+
            '</div>'+
            '<div class="col-md-1">'+
              '{{Form::label('','')}} <span class="text-danger"></span>'+
              '<br>'+
              '<button onclick="eliminarRepresentante('+cont+');" type="button" class="btn btn-danger">-</button>'+
            '</div>'+
          '</div>' + 
          '<div class="row mb-1">'+
              '<div class="col-md-3">'+
                  '{{Form::label("documento_designacion'+cont+'",'Documento de Designación')}} <span class="text-danger">(*)</span>'+
                  '<div class="col-md-12">'+
                  '<input id="documento_designacion'+cont+'" type="text" class="form-control {{ $errors->has('documento_designacion1') ? ' error' : '' }}" name="documento_designacion'+cont+'" value="" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">'+
                  '<span id="error-documento_designacion'+cont+'" class="error-documento_designacion'+cont+'" style="color: rgb(220, 53, 69);"></span>'+
                  '@if ($errors->has('documento_designacion1'))'+
                      '<span class="text-danger">'+
                          '{{ $errors->first('documento_designacion1') }}'+
                      '</span>'+
                  '@endif'+
                  '</div>'+
              '</div>'+
              '<div class="col-md-3">'+
                  '{{Form::label("fecha_emision_documento'+cont+'",'Fecha Emisión de Documento')}} <span class="text-danger">(*)</span>'+
                  '<div class="col-md-12">'+
                  '<input id="fecha_emision_documento'+cont+'" type="date" class="form-control {{ $errors->has('fecha_emision_documento1') ? ' error' : '' }}" name="fecha_emision_documento'+cont+'" value="">'+
                  '<span id="error-fecha_emision_documento'+cont+'" class="error-fecha_emision_documento'+cont+'" style="color: rgb(220, 53, 69);"></span>'+
                  '@if ($errors->has('fecha_emision_documento1'))'+
                      '<span class="text-danger">'+
                          '{{ $errors->first('fecha_emision_documento1') }}'+
                      '</span>'+
                  '@endif'+
                  '</div>'+
              '</div>'+
              '<div class="col-md-3">'+
                  '{{Form::label("notaria1'+cont+'",'Notaria')}} <span class="text-danger">(*)</span>'+
                  '<div class="col-md-112">'+
                  '<input id="notaria'+cont+'" type="text" class="form-control {{ $errors->has('notaria1') ? ' error' : '' }}" name="notaria'+cont+'" value="" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">'+
                  '<span id="error-notaria'+cont+'" class="error-notaria'+cont+'" style="color: rgb(220, 53, 69);"></span>'+
                  '@if ($errors->has('notaria1'))'+
                      '<span class="text-danger">'+
                          '{{ $errors->first('notaria1') }}'+
                      '</span>'+
                  '@endif'+
                  '</div>'+
              '</div>'+
              '<div class="col-md-3">'+
                  '{{Form::label("notario1'+cont+'",'Notario (a)')}} <span class="text-danger">(*)</span>'+
                  '<div class="col-md-10">'+
                  '<input id="notario'+cont+'" type="text" class="form-control {{ $errors->has('notario1') ? ' error' : '' }}" name="notario'+cont+'" value="" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">'+
                  '<span id="error-notario'+cont+'" class="error-notario'+cont+'" style="color: rgb(220, 53, 69);"></span>'+
                  '@if ($errors->has('notario1'))'+
                      '<span class="text-danger">'+
                          '{{ $errors->first('notario1') }}'+
                      '</span>'+
                  '@endif'+
                  '</div>'+
              '</div>'+
          '</div>'+
        '</div>';
      } else{
        var content = 
        '<div id="row-'+cont+'">'+
          '<div class="row mb-1">'+
            '<div class="col-md-5">'+
                '{{Form::label("representante'+cont+'",'Representante')}} <span class="text-danger">(*)</span>'+
                '<input id="representante'+cont+'" type="text" class="form-control {{ $errors->has("representante'+cont+'") ? ' error' : '' }}" name="representante'+cont+'" value="" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">'+
                '<span id="error-representante'+cont+'" class="error-representante'+cont+'" style="color: rgb(220, 53, 69);"></span>'+
                '@if ($errors->has('representante1'))'+
                    '<span class="text-danger">'+
                        '{{ $errors->first('representante1') }}'+
                    '</span>'+
                '@endif'+
            '</div>'+
            '<div class="col-md-3">'+
                '{{Form::label("numero_documento'+cont+'",'Número De Documento')}} <span class="text-danger">(*)</span>'+
                '<input id="numero_documento'+cont+'" type="text" class="form-control {{ $errors->has('numero_documento1') ? ' error' : '' }}" name="numero_documento'+cont+'" value="" autofocus onkeyup="this.value = this.value.toUpperCase();" autocomplete="off" data-validate="length" data-min-length="3" data-max-length="50">'+
                '<span id="error-numero_documento'+cont+'" class="error-numero_documento'+cont+'" style="color: rgb(220, 53, 69);"></span>'+
                '@if ($errors->has('numero_documento1'))'+
                    '<span class="text-danger">'+
                        '{{ $errors->first('numero_documento1') }}'+
                    '</span>'+
                '@endif'+
            '</div>'+
            '<div class="col-md-3">'+
                '{{Form::label("expedido'+cont+'",'Expedido en')}}'+
                '<select id="expedido'+cont+'" class="form-control{{ $errors->has('expedido1') ? ' error' : '' }}" name="expedido'+cont+'">'+
                    '<option value="">Seleccionar...</option>'+
                    '@foreach($expedidos as $expedido)'+
                        '<option value="{{ $expedido->id }}"'+ 
                            '{{ "$contrato->expedido1'+cont'" == $expedido->id ? 'selected' : '' }}>'+
                            '{{ $expedido->descripcion }}'+
                        '</option>'+
                    '@endforeach'+
                '</select>'+
                '@if ($errors->has('expedido'))'+
                    '<span class="text-danger">'+
                        '{{ $errors->first('expedido') }}'+
                    '</span>'+
                '@endif'+
            '</div>'+
            '<div class="col-md-1">'+
              '{{Form::label('','')}} <span class="text-danger"></span>'+
              '<br>'+
              '<button onclick="eliminarRepresentante('+cont+');" type="button" class="btn btn-danger">-</button>'+
            '</div>'+
          '</div>'+
        '</div>';
      }

      
      // Elimina los campos antes de añadir un representante
      var parentDiv = document.getElementById('campos'); 
      while (parentDiv.children.length > (cont-1)) {
          parentDiv.removeChild(parentDiv.lastChild);
      }

      //Agrega un nuevo espacio
      $("#campos").append(content);
      cont++;
    
    } else {
      alert("No se pueden registrar más de 3 representantes")
    }
  }

  function eliminarRepresentante(id) {
    if (id === cont-1) {
      $("#row-" + id).remove();
      cont--;
    } else{
      alert('No puede eliminar al Representante '+id+', primero debe eliminar el Representante '+(cont-1));
    }
  }

</script>
@endsection