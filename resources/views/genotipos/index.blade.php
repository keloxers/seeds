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
      {{ Form::open(array('route' => 'genotipos.finder', 'class' => 'form-inline', 'role' => 'form')) }}
      <div class="form-group mb-2">
        <input type="text" class="form-control" name="buscar" id="buscar" value="">
        {{ Form::hidden('genotipo_id', '', array('id' => 'genotipo_id', 'name' => 'genotipo_id')) }}
      </div>
      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
      </form>
    </div>
    <div class="col-6 text-right">
      <a href="/genotipos/{{$huerta->id}}/create">
        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
      </a>
    </div>
  </div>

  @if($genotipos)

  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Genotipo</th>
        <th scope="col">Familia</th>
        <th scope="col">Linea</th>
        <th scope="col">Posicion</th>
        <th scope="col">Comentarios</th>
        <th scope="col">Activo</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($genotipos as $genotipo)
      <tr>
        <td>{{ $genotipo->genotipo}}</td>
        <td>{{ $genotipo->familias->familia}}</td>
        <td>{{ $genotipo->linea}}</td>
        <td>{{ $genotipo->posicion}}</td>
        <td>{{ $genotipo->comentarios}}</td>
        <td>
          @if ($genotipo->activo)
            <span class="badge badge-success">Si</span>
          @else
            <span class="badge badge-danger">No</span>
          @endif
        </td>
        <td>
          <h5>
          <a href="/genotipos/{{ $genotipo->id }}/edit"><i class="fas fa-edit"></i></a>
          <a href="/genotipos/{{ $genotipo->id }}"><i class="fas fa-eye"></i></a>
        </h5>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $genotipos->links() }}

  @endif

</div>
@endsection
