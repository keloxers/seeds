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

                {{ Form::open(array('url' => '/familias/' . $familia->id, 'class' => 'form-group', 'role' => 'form')) }}
                {{ Form::hidden('_method', 'DELETE') }}

                <div class="form-group">
                  <label for="">Familia</label>
                  {{ $familia->familia}}
                </div>
                <div class="form-group">
                  <label for="">Origen</label>
                  {{ $familia->origens->origen}}
                </div>

                <div class="form-group">
                  <label for="activo">Estado</label>

                  @if ($familia->activo)
                    <span class="badge badge-success">Activo</span>
                  @else
                    <span class="badge badge-danger">Inactivo</span>
                  @endif


                </div>
                <button type="submit" class="btn btn-danger">Borrar</button>
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
