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
      {{ Form::open(array('route' => 'origens.finder', 'class' => 'form-inline', 'role' => 'form')) }}
      <div class="form-group mb-2">
        <input type="text" class="form-control" name="buscar" id="buscar" value="">
        {{ Form::hidden('origen_id', '', array('id' => 'origen_id', 'name' => 'origen_id')) }}
      </div>
      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
      </form>
    </div>
    <div class="col-6 text-right">
      <a href="/origens/create">
        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
      </a>
    </div>
  </div>

  @if($origens)

  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Origen</th>
        <th scope="col">Comentarios</th>
        <th scope="col">Estado</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($origens as $origen)
      <tr>
        <td>
          <a href="/origens/{{ $origen->id }}/maestros">
          {{ $origen->origen}}
          </a>
        </td>
        <td>
          {{ $origen->comentarios}}
        </td>
        <td>
          @if ($origen->activo)
            <span class="badge badge-success">Activo</span>
          @else
            <span class="badge badge-danger">Inactivo</span>
          @endif
        </td>
        <td>
          <h5>
          <a href="/origens/{{ $origen->id }}/edit" data-toggle="tooltip" title="Editar"><i class="fas fa-edit"></i></a>
          <a href="/origens/{{ $origen->id }}" data-toggle="tooltip" title="Ver"><i class="fas fa-eye"></i></a>
        </h5>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $origens->links() }}

  @endif

</div>
@endsection
