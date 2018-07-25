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
      {{ Form::open(array('route' => 'categorias.finder', 'class' => 'form-inline', 'role' => 'form')) }}
      <div class="form-group mb-2">
        <input type="text" class="form-control" name="buscar" id="buscar" value="">
        {{ Form::hidden('categorias_id', '', array('id' => 'categorias_id', 'name' => 'categorias_id')) }}
      </div>
      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
      </form>
    </div>
    <div class="col-6 text-right">
      <a href="/categorias/create">
        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
      </a>
    </div>
  </div>

  @if($categorias)

  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Categoria</th>
        <th scope="col">Estado</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categorias as $categoria)
      <tr>
        <td>
          <a href="/categorias/{{ $categoria->id }}/preguntas">
          {{ $categoria->categoria}}
          </a>
        </td>
        <td>
          @if ($categoria->activo)
            <span class="badge badge-success">Activo</span>
          @else
            <span class="badge badge-danger">Inactivo</span>
          @endif
        </td>
        <td>
          <h5>
          <a href="/categorias/{{ $categoria->id }}/edit"><i class="fas fa-edit"></i></a>
          <a href="/categorias/{{ $categoria->id }}/preguntas"><i class="fas fa-eye"></i></a>
        </h5>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $categorias->links() }}

  @endif

</div>
@endsection
