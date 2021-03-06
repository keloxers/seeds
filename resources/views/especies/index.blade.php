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
      {{ Form::open(array('route' => 'especies.finder', 'class' => 'form-inline', 'role' => 'form')) }}
      <div class="form-group mb-2">
        <input type="text" class="form-control" name="buscar" id="buscar" value="">
        {{ Form::hidden('especie_id', '', array('id' => 'especie_id', 'name' => 'especie_id')) }}
      </div>
      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
      </form>
    </div>
    <div class="col-6 text-right">
      <a href="/especies/create">
        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
      </a>
    </div>
  </div>

  @if($especies)

  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Especie</th>
        <th scope="col">Estado</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($especies as $especie)
      <tr>
        <td>
          <a href="/especies/{{ $especie->id }}/familias">
          {{ $especie->especie}}
          </a>
        </td>
        <td>
          @if ($especie->activo)
            <span class="badge badge-success">Activo</span>
          @else
            <span class="badge badge-danger">Inactivo</span>
          @endif
        </td>
        <td>
          <h5>
          <a href="/especies/{{ $especie->id }}/edit" data-toggle="tooltip" title="Editar"><i class="fas fa-edit"></i></a>
          <a href="/especies/{{ $especie->id }}/familias" data-toggle="tooltip" title="Familias"><i class="fas fa-code-branch"></i></a>
        </h5>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $especies->links() }}

  @endif

</div>
@endsection
