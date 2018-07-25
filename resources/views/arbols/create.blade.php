@extends('layouts.app')

@section('content')
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
    minLength: 2,
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
        <div class="card-header">
          <h1>
            <a href="/huertas/{{$huerta->id}}/arbols">
              <i class="fas fa-caret-square-left"></i>
            </a>
            {{ $title }}
          </h1>
          <h4>{{$huerta->huerta}}</h4>
        </div>

        <div class="card-body">

          <div class="container">
            <div class="row">

              <div class="col-12">

                {{ Form::open(array('route' => 'arbols.store',  'autocomplete' => 'off')) }}
                {{ Form::hidden('huertas_id', $huerta->id, array('id' => 'huertas_id', 'name' => 'huertas_id')) }}
                <div class="form-group">
                  <label for="">Maestro</label>
                  <input type="text" class="form-control" name="maestro" id="maestro" placeholder="Ingrese maestro">
                </div>

                <div class="form-group">
                  <label for="">Arbol</label>
                  <input type="text" class="form-control" name="arbol" id="arbol" placeholder="Ingrese el nombre Arbol">
                </div>


                <div class="form-group">
                  <label for="">Linea</label>
                  <input type="text" class="form-control" name="linea" id="linea" placeholder="Ingrese linea">
                </div>


                <div class="form-group">
                  <label for="">Posicion</label>
                  <input type="text" class="form-control" name="posicion" id="posicion" placeholder="Ingrese Posicion">
                </div>

                <div class="form-group">
                  <label for="">Fecha plantación</label><br>
                  <input type="text" id="date" name="date" class="form-control">
                </div>


                <div class="form-group">
                  <label for="activo">Activo</label>
                  <input type="checkbox" data-toggle="toggle" name="activo" id="activo">
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
