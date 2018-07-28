@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <h1>
      {{$title}}</h1>

      <br>
    </div>
  </div>

  <div class="row">
    <div class="col-6">
      {{ Form::open(array('route' => 'huertas.finder', 'class' => 'form-inline', 'role' => 'form')) }}
      <div class="form-group mb-2">
        <input type="text" class="form-control" name="buscar" id="buscar" value="">
        {{ Form::hidden('huerta_id', '', array('id' => 'huerta_id', 'name' => 'huerta_id')) }}
      </div>
      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
      </form>
    </div>
    <div class="col-6 text-right">
      <a href="/huertas/create">
        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
      </a>
    </div>
  </div>

  @if($huertas)

  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Huerta</th>
        <th scope="col">Lineas</th>
        <th scope="col">Arboles</th>
        <th scope="col">Estado</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($huertas as $huerta)
      <tr>
        <td>
          <a href="/huertas/{{ $huerta->id }}/genotipos">
          {{ $huerta->huerta}}
          </a>
        </td>
        <td>{{ $huerta->lineas}}</td>
        <td>{{ $huerta->arboles}}</td>
        <td>
          @if ($huerta->activo)
            <span class="badge badge-success">Activo</span>
          @else
            <span class="badge badge-danger">Inactivo</span>
          @endif
        </td>
        <td>
          <h5>
          <a href="/huertas/{{ $huerta->id }}/edit"><i class="fas fa-edit"></i></a>
          <a href="/huertas/{{ $huerta->id }}/genotipos"><i class="fas fa-eye"></i></a>
          <a href="/huertas/{{ $huerta->id }}/manejos"><i class="fas fa-hand-rock"></i></a>
        </h5>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $huertas->links() }}

  @endif

</div>
@endsection
