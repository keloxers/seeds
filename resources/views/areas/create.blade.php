@extends('layouts.app')

@section('content')


<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h1>
            <a href="/manejos/{{$manejo->id}}/areas">
              <i class="fas fa-caret-square-left"></i>
            </a>
            {{ $title }}
          </h1>
          <!-- <h4>{{$manejo->manejo}}</h4> -->
        </div>

        <div class="card-body">

          <div class="container">
            <div class="row">

              <div class="col-12">

                {{ Form::open(array('route' => 'areas.store',  'autocomplete' => 'off')) }}
                {{ Form::hidden('manejos_id', $manejo->id, array('id' => 'manejos_id', 'name' => 'manejos_id')) }}


                <div class="form-group">
                  <label for="">Desde Linea</label>
                  <input type="text" class="form-control" name="desdelinea" id="desdelinea" placeholder="Desde Linea">
                </div>

                <div class="form-group">
                  <label for="">Desde Posicion</label>
                  <input type="text" class="form-control" name="desdeposicion" id="desdeposicion" placeholder="Desde Posicion">
                </div>

                <div class="form-group">
                  <label for="">Hasta Linea</label>
                  <input type="text" class="form-control" name="hastalinea" id="hastalinea" placeholder="Hasta Linea">
                </div>

                <div class="form-group">
                  <label for="">Hasta Posicion</label>
                  <input type="text" class="form-control" name="hastaposicion" id="hastaposicion" placeholder="Hasta Posicion">
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
