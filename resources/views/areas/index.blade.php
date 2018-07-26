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
      {{ Form::open(array('route' => 'areas.finder', 'class' => 'form-inline', 'role' => 'form')) }}
      <div class="form-group mb-2">
        <input type="text" class="form-control" name="buscar" id="buscar" value="">
        {{ Form::hidden('area_id', '', array('id' => 'area_id', 'name' => 'area_id')) }}
      </div>
      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
      </form>
    </div>
    <div class="col-6 text-right">
      <a href="/areas/{{$manejo->id}}/create">
        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
      </a>
    </div>
  </div>

  @if($areas)

  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Desde Linea</th>
        <th scope="col">Hasta Linea</th>
        <th scope="col">Desde Posicion</th>
        <th scope="col">Desde Posicion</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($areas as $area)
      <tr>
        <td>{{ $area->desdelinea}}</td>
        <td>{{ $area->hastalinea}}</td>
        <td>{{ $area->desdeposicion}}</td>
        <td>{{ $area->hastaposicion}}</td>        
        <td>
          <h5>
          <a href="/areas/{{ $area->id }}/edit"><i class="fas fa-edit"></i></a>
        </h5>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $areas->links() }}

  @endif

</div>
@endsection
