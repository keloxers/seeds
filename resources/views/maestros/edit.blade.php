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

                {{ Form::open(array('url' => URL::to('maestros/' . $maestro->id), 'method' => 'PUT', 'role' => 'form')) }}
                {{ Form::hidden('maestros_id', $maestro->id, array('id' => 'maestros_id', 'name' => 'maestros_id')) }}

                <div class="form-group">
                  <label for="">maestro</label>
                  {{ Form::text('maestro', $maestro->maestro, array('id' => 'maestro', 'name' => 'maestro', 'class' => "form-control" , 'placeholder' => 'Ingrese un maestro')) }}
                </div>
                <div class="form-group">
                  <label for="activo">Activo</label>
                  <input type="checkbox" data-toggle="toggle" name="activo" id="activo"
                  @if ($maestro->activo)
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
