@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          <h1>
            <a href="/especies/{{$especie->id}}/maestros">
              <i class="fas fa-caret-square-left"></i>
            </a>
            {{ $title }}
          </h1>
          <h4>{{$especie->especie}}</h4>
        </div>
        <div class="card-body">
          <div class="container">
            <div class="row">
              <div class="col-12">
                {{ Form::open(array('route' => 'maestros.store',  'autocomplete' => 'off')) }}
                {{ Form::hidden('especies_id', $especie->id, array('id' => 'especies_id', 'name' => 'especies_id')) }}
                <div class="form-group">
                  <label for="">Maestro</label>
                  <input type="text" class="form-control" name="maestro" id="maestro" placeholder="Ingrese maestro">
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
