@extends('layouts.app')

@section('content')


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

                {{ Form::open(array('route' => 'origens.store',  'autocomplete' => 'off')) }}

                <div class="form-group">
                  <label for="">Origen</label>
                  <input type="text" class="form-control" name="origen" id="origen" placeholder="Ingrese nombre de origen">
                </div>


                <div class="form-group">
                  <label for="activo">Activo</label>
                  <input type="checkbox" data-toggle="toggle" name="activo" id="activo" checked>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Comentarios</label>
                  <textarea class="form-control" id="comentarios" name="comentarios" rows="5"></textarea>
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
