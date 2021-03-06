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
      {{ Form::open(array('route' => 'familias.finder', 'class' => 'form-inline', 'role' => 'form')) }}
      <div class="form-group mb-2">
        <input type="text" class="form-control" name="buscar" id="buscar" value="">
        {{ Form::hidden('familia_id', '', array('id' => 'familia_id', 'name' => 'familia_id')) }}
      </div>
      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
      </form>
    </div>
    <div class="col-6 text-right">
      <a href="/familias/{{$especie->id}}/create">
        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
      </a>
    </div>
  </div>

  @if($familias)

  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Familia</th>
        <th scope="col">Origen</th>
        <th scope="col">Activo</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($familias as $familia)
      <tr>
        <td>{{ $familia->familia}}</td>
        <td>{{ $familia->origens->origen}}</td>
        <td>
          @if ($familia->activo)
            <span class="badge badge-success">Si</span>
          @else
            <span class="badge badge-danger">No</span>
          @endif
        </td>
        <td>
          <h5>
          <a href="/familias/{{ $familia->id }}/edit" data-toggle="tooltip" title="Editar"><i class="fas fa-edit"></i></a>
          <a href="/familias/{{ $familia->id }}" data-toggle="tooltip" title="Ver"><i class="fas fa-eye"></i></a>
        </h5>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $familias->links() }}

  @endif

</div>
@endsection
