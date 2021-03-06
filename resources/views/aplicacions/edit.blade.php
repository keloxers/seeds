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

                {{ Form::open(array('url' => URL::to('aplicacions/' . $aplicacion->id), 'method' => 'PUT', 'role' => 'form')) }}
                <div class="form-group">
                  <label for="">aplicacion</label>
                  {{ Form::text('aplicacion', $aplicacion->aplicacion, array('id' => 'aplicacion', 'name' => 'aplicacion', 'class' => "form-control" , 'placeholder' => 'Ingrese un aplicacion')) }}
                </div>
                <div class="form-group">
                  <label for="activo">Activo</label>
                  <input type="checkbox" data-toggle="toggle" name="activo" id="activo"
                  @if ($aplicacion->activo)
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
