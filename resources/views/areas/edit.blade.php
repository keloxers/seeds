@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header"><h1>{{ $title }}</h1></div>

        <div class="card-body">

          <div class="container">
            <div class="row">

              <div class="col-12">

                {{ Form::open(array('url' => URL::to('areas/' . $area->id), 'method' => 'PUT', 'role' => 'form')) }}
                {{ Form::hidden('areas_id', $area->id, array('id' => 'areas_id', 'name' => 'areas_id')) }}

                  <div class="form-group">
                    <label for="">Desde Linea</label>
                    {{ Form::text('desdelinea', $area->desdelinea, array('id' => 'desdelinea', 'name' => 'desdelinea', 'class' => "form-control" , 'placeholder' => 'Desde Linea')) }}
                  </div>

                  <div class="form-group">
                    <label for="">Desde Posicion</label>
                    {{ Form::text('desdeposicion', $area->desdeposicion, array('id' => 'desdeposicion', 'name' => 'desdeposicion', 'class' => "form-control" , 'placeholder' => 'Desde posicion')) }}
                  </div>

                  <div class="form-group">
                    <label for="">Hasta Linea</label>
                    {{ Form::text('hastalinea', $area->hastalinea, array('id' => 'hastalinea', 'name' => 'hastalinea', 'class' => "form-control" , 'placeholder' => 'Hasta linea')) }}
                  </div>

                  <div class="form-group">
                    <label for="">Hasta Posicion</label>
                    {{ Form::text('hastaposicion', $area->hastaposicion, array('id' => 'hastaposicion', 'name' => 'hastaposicion', 'class' => "form-control" , 'placeholder' => 'Hasta posicion')) }}
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
