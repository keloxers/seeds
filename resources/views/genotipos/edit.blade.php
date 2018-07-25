@extends('layouts.app')

@section('content')
<?php
      use Carbon\Carbon;
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
$( function() {
  $.noConflict();
  $( "#maestro" ).autocomplete({
    source: "/maestros/search",
    minLength: 1,
    select: function( event, ui ) {

      $('#maestros_id').val( ui.item.id );
    }
  });

  // $( "#datepicker" ).datepicker("option", "dateFormat", "dd/mm/yy");

  var date_input=$('input[name="date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options={
          format: 'dd/mm/yyyy',
          container: container,
          todayHighlight: true,
          autoclose: true,
        };
        date_input.datepicker(options);
} );
</script>



<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h1>{{ $title }}</h1></div>

        <div class="card-body">

          <div class="container">
            <div class="row">

              <div class="col-12">

                {{ Form::open(array('url' => URL::to('genotipos/' . $genotipo->id), 'method' => 'PUT', 'role' => 'form')) }}

                <div class="form-group">
                  <label for="">Maestro</label>
                  {{ Form::text('maestro', $genotipo->maestros->maestro, array('id' => 'maestro', 'name' => 'maestro', 'class' => "form-control" , 'placeholder' => 'Ingrese maestro')) }}
                  {{ Form::hidden('maestros_id', $genotipo->maestros_id, array('id' => 'maestros_id', 'name' => 'maestros_id')) }}
                </div>

                <div class="form-group">
                  <label for="">genotipo</label>
                  {{ Form::text('genotipo', $genotipo->genotipo, array('id' => 'genotipo', 'name' => 'genotipo', 'class' => "form-control" , 'placeholder' => 'Ingrese un genotipo')) }}
                </div>


                <div class="form-group">
                  <label for="">Linea</label>
                  {{ Form::text('linea', $genotipo->linea, array('id' => 'linea', 'name' => 'linea', 'class' => "form-control" , 'placeholder' => 'Ingrese linea')) }}
                </div>


                <div class="form-group">
                  <label for="">Posicion</label>
                  {{ Form::text('posicion', $genotipo->posicion, array('id' => 'posicion', 'name' => 'posicion', 'class' => "form-control" , 'placeholder' => 'Ingrese posicion')) }}
                </div>

                <?php
                    $fecha = new Carbon($genotipo->fechaplantacion);
                 ?>


                <div class="form-group">
                  <label for="">Fecha plantación</label><br>
                  <input type="text" value='{{$fecha->format('d/m/Y')}}' id="date" name="date" class="form-control">
                </div>


                <div class="form-group">
                  <label for="activo">Activo</label>
                  <input type="checkbox" data-toggle="toggle" name="activo" id="activo"
                  @if ($genotipo->activo)
                    checked
                  @endif
                  >

                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                {{ Form::close() }}
              </div>

            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>




@stop
