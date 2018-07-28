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
  $( "#familia" ).autocomplete({
    source: "/familias/search",
    minLength: 1,
    select: function( event, ui ) {

      $('#familias_id').val( ui.item.id );
    }
  });


} );
</script>



<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h1>
            <a href="/huertas/{{$huerta->id}}/genotipos">
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

                {{ Form::open(array('route' => 'genotipos.store',  'autocomplete' => 'off')) }}
                {{ Form::hidden('huertas_id', $huerta->id, array('id' => 'huertas_id', 'name' => 'huertas_id')) }}
                <div class="form-group">
                  <label for="">Familia</label>
                  <input type="text" class="form-control" name="familia" id="familia" placeholder="Ingrese familia">
                  {{ Form::hidden('familias_id', '', array('id' => 'familias_id', 'name' => 'familias_id')) }}
                </div>

                <div class="form-group">
                  <label for="">Genotipo</label>
                  <input type="text" class="form-control" name="genotipo" id="genotipo" placeholder="Ingrese el nombre genotipo">
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
                  <label for="exampleFormControlTextarea1">Comentarios</label>
                  <textarea class="form-control" id="comentarios" name="comentarios" rows="5"></textarea>
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
