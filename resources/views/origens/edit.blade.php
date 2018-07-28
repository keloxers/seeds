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

                {{ Form::open(array('url' => URL::to('origens/' . $origen->id), 'method' => 'PUT', 'role' => 'form')) }}
                <div class="form-group">
                  <label for="">Origen</label>
                  {{ Form::text('origen', $origen->origen, array('id' => 'origen', 'name' => 'origen', 'class' => "form-control" , 'placeholder' => 'Ingrese un origen')) }}
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Comentarios</label>
                  <textarea class="form-control" id="comentarios" name="comentarios" rows="5">{{$origen->comentarios}}</textarea>
                </div>


                <div class="form-group">
                  <label for="activo">Activo</label>
                  <input type="checkbox" data-toggle="toggle" name="activo" id="activo"
                  @if ($origen->activo)
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
