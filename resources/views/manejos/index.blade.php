@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <h1>{{$title}}</h1>
      <br>
    </div>
  </div>

  <div class="row">
    <div class="col-6">
      {{ Form::open(array('route' => 'manejos.finder', 'class' => 'form-inline', 'role' => 'form')) }}
      <div class="form-group mb-2">
        <input type="text" class="form-control" name="buscar" id="buscar" value="">
        {{ Form::hidden('manejo_id', '', array('id' => 'manejo_id', 'name' => 'manejo_id')) }}
      </div>
      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
      </form>
    </div>
    <div class="col-6 text-right">
      <a href="/manejos/{{$huerta->id}}/create">
        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
      </a>
    </div>
  </div>

  @if($manejos)

  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Fecha</th>
        <th scope="col">Aplicacion</th>
        <th scope="col">Estado</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($manejos as $manejo)
      <tr>
        <td>{{ $manejo->fecha}}</td>
        <td>{{ $manejo->aplicacions->aplicacion}}</td>
        <td>
          @if ($manejo->activo)
            <span class="badge badge-success">Si</span>
          @else
            <span class="badge badge-danger">No</span>
          @endif
        </td>
        <td>
          <h5>
          <a href="/manejos/{{ $manejo->id }}/edit"><i class="fas fa-edit"></i></a>
          <a href="/manejos/{{ $manejo->id }}/areas"><i class="fas fa-vector-square"></i></a>
        </h5>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $manejos->links() }}

  @endif

</div>
@endsection
