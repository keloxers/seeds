@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script>
$( function() {
  $.noConflict();
  $( "#origen" ).autocomplete({
    source: "/origens/search",
    minLength: 1,
    select: function( event, ui ) {

      $('#origens_id').val( ui.item.id );
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

                {{ Form::open(array('url' => URL::to('familias/' . $familia->id), 'method' => 'PUT', 'role' => 'form')) }}
                {{ Form::hidden('familias_id', $familia->id, array('id' => 'familias_id', 'name' => 'familias_id')) }}

                <div class="form-group">
                  <label for="">Familia</label>
                  {{ Form::text('familia', $familia->familia, array('id' => 'familia', 'name' => 'familia', 'class' => "form-control" , 'placeholder' => 'Ingrese un familia')) }}
                </div>
                <div class="form-group">
                  <label for="">Origen</label>
                  <input type="text" class="form-control" name="origen" id="origen" placeholder="Ingrese Origen" value="{{$familia->origens->origen}}">
                  {{ Form::hidden('origens_id', $familia->origen_id, array('id' => 'origens_id', 'name' => 'origens_id')) }}
                </div>

                <div class="form-group">
                  <label for="activo">Activo</label>
                  <input type="checkbox" data-toggle="toggle" name="activo" id="activo"
                  @if ($familia->activo)
                    checked
                  @endif
                  >

                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
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
