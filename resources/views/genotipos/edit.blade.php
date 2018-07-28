@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


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

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Comentarios</label>
                  <textarea class="form-control" id="comentarios" name="comentarios" rows="5">{{$origen->comentarios}}</textarea>
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
