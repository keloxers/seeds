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
      {{ Form::open(array('route' => 'arbols.finder', 'class' => 'form-inline', 'role' => 'form')) }}
      <div class="form-group mb-2">
        <input type="text" class="form-control" name="buscar" id="buscar" value="">
        {{ Form::hidden('arbol_id', '', array('id' => 'arbol_id', 'name' => 'arbol_id')) }}
      </div>
      <button type="submit" class="btn btn-primary mb-2">Buscar</button>
      </form>
    </div>
    <div class="col-6 text-right">
      <a href="/arbols/{{$huerta->id}}/create">
        <button type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
      </a>
    </div>
  </div>

  @if($arbols)

  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Arbol</th>
        <th scope="col">Activo</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($arbols as $arbol)
      <tr>
        <td>
          {{ $arbol->arbol}}
        </td>
        <td>
          @if ($arbol->activo)
            <span class="badge badge-success">Si</span>
          @else
            <span class="badge badge-danger">No</span>
          @endif
        </td>
        <td>
          <h5>
          <a href="/arbols/{{ $arbol->id }}/edit"><i class="fas fa-edit"></i></a>
          <a href="/arbols/{{ $arbol->id }}/arbol"><i class="fas fa-eye"></i></a>
        </h5>

        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $arbols->links() }}

  @endif

</div>
@endsection
