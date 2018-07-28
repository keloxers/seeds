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
  $( "#role" ).autocomplete({
    source: "/roles/search",
    minLength: 2,
    select: function( event, ui ) {

      $('#roles_id').val( ui.item.id );
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
            {{ $title }}
          </h1>
        </div>

        <div class="card-body">

          <div class="container">
            <div class="row">

              <div class="col-12">

                {{ Form::open(array('route' => 'huertas.store',  'autocomplete' => 'off')) }}

                <div class="form-group">
                  <label for="">Huerta</label>
                  <input type="text" class="form-control" name="huerta" id="huerta" placeholder="Ingrese nombre de huerta">
                </div>

                <div class="form-group">
                  <label for="">Lineas</label>
                  <input type="text" class="form-control" name="lineas" id="lineas" placeholder="Ingrese lineas">
                </div>

                <div class="form-group">
                  <label for="">Arboles</label>
                  <input type="text" class="form-control" name="arboles" id="arboles" placeholder="Ingrese cantidad arboles">
                </div>

                <div class="form-group">
                  <label for="">Fecha creacion</label><br>
                  <input type="text" id="date" name="date" class="form-control">
                </div>

                <div class="form-group">
                  <label for="activo">Activo</label>
                  <input type="checkbox" data-toggle="toggle" name="activo" id="activo" checked>
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
