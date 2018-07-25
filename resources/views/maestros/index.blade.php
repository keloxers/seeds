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
      {{ Form::open(array('route' => 'maestros.finder', 'class' => 'form-inline', 'role' => 'form')) }}
      <div class="form-group mb-2">
        <input type="text" class="form-control" name="buscar" id="buscar" value="">
        {{ Form::hidden('maestro_id', '', array('id' => 'maestro_id', 'name' => 'maestro_id')) }}
      </div>
      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
      </form>
    </div>
    <div class="col-6 text-right">
      <a href="/maestros/{{$especie->id}}/create">
        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
      </a>
    </div>
  </div>

  @if($maestros)

  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Maestro</th>
        <th scope="col">Activo</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($maestros as $maestro)
      <tr>
        <td>
          {{ $maestro->maestro}}
        </td>
        <td>
          @if ($maestro->activo)
            <span class="badge badge-success">Si</span>
          @else
            <span class="badge badge-danger">No</span>
          @endif
        </td>
        <td>
          <h5>
          <a href="/maestros/{{ $maestro->id }}/edit"><i class="fas fa-edit"></i></a>
          <a href="/maestros/{{ $maestro->id }}"><i class="fas fa-eye"></i></a>
        </h5>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $maestros->links() }}

  @endif

</div>
@endsection
