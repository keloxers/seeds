<?php

namespace App\Http\Controllers;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use Validator;
use Bouncer;
use App\Categoria;
use App\Huerta;
use App\Genotipo;

use Carbon\Carbon;


class GenotipoController extends Controller
{

  public function index($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $huerta = Huerta::find($id);
    $genotipos = Genotipo::where('huertas_id',$id)->paginate(25);
    $title = "Huerta: " . $huerta->huerta;
    return view('genotipos.index', ['huerta' => $huerta, 'genotipos' => $genotipos, 'title' => $title ]);

  }



    public function create($id)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $huerta = Huerta::find($id);

      $title = "Crear genotipo en huerta:";
      return view('genotipos.create', ['huerta' => $huerta, 'title' => $title]);
    }



    public function store(Request $request)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $validator = Validator::make($request->all(), [
        'huertas_id' => 'required|exists:huertas,id',
        'familias_id' => 'required|exists:familias,id',
      ]);


      if ($validator->fails()) {
        foreach($validator->messages()->getMessages() as $field_name => $messages) {
          foreach($messages AS $message) {
            $errors[] = $message;
          }
        }
        return redirect()->back()->with('errors', $errors)->withInput();
        die;
      }

      $activo = 0;
      if ($request->activo=='on') { $activo = 1; }


      $genotipo = Genotipo::where('huertas_id', $request->huertas_id)
                            ->where('linea', $request->linea)
                            ->where('posicion', $request->posicion)
                            ->first();
      if($genotipo) {
        $errors[] = 'Ya existe un genotipo cargada para esa linea y posición.';
        return redirect()->back()->with('errors', $errors)->withInput();
        die;
      }


      $genotipo = new Genotipo;
      $genotipo->huertas_id = $request->huertas_id;
      $genotipo->familias_id = $request->familias_id;
      $genotipo->genotipo = $request->genotipo;
      $genotipo->linea = $request->linea;
      $genotipo->posicion = $request->posicion;
      $genotipo->comentarios = $request->comentarios;
      $genotipo->activo = $activo;

      $genotipo->save();
      return redirect('genotipos/' . $request->huertas_id . '/create');




    }





  public function edit($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $genotipo = Genotipo::find($id);
    $title = "genotipo Editar";
    return view('genotipos.edit', ['genotipo' => $genotipo, 'title' => $title ]);
  }



  public function update(Request $request, $id)
  {
    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $validator = Validator::make($request->all(), [
      'genotipo' => 'required|unique:genotipos,id,'.$id . '|max:125',
      'huertas_id' => 'required|exists:huertas,id',
      'familias_id' => 'required|exists:familias,id',
    ]);


    if ($validator->fails()) {
      foreach($validator->messages()->getMessages() as $field_name => $messages) {
        foreach($messages AS $message) {
          $errors[] = $message;
        }
      }
      return redirect()->back()->with('errors', $errors)->withInput();
      die;
    }


          $activo = 0;
          if ($request->activo=='on') { $activo = 1; }

          $genotipo = Genotipo::find($id);
          $huertas_id = $genotipo->huertas_id;
          $genotipo->familias_id = $request->familias_id;
          $genotipo->genotipo = $request->genotipo;
          $genotipo->linea = $request->linea;
          $genotipo->posicion = $request->posicion;
          $genotipo->comentarios = $request->comentarios;
          $genotipo->activo = $activo;

          $genotipo->save();

          return redirect('/huertas/' . $huertas_id . '/genotipos');



    return redirect('/categorias');

  }




  public function destroy($id)
  {
    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $request = new Request([
      'id' => $id,
    ]);

    $validator = Validator::make($request->all(), [
      'id' => 'required|exists:categorias,id',
    ]);


    if ($validator->fails()) {
      foreach($validator->messages()->getMessages() as $field_name => $messages) {
        foreach($messages AS $message) {
          $errors[] = $message;
        }
      }
      return redirect()->back()->with('errors', $errors)->withInput();
      die;
    }

    $categoria = Genotipo::find($id);
    $categoria->delete();
    return redirect('/categorias/');


  }




    public function finder(Request $request){

      $categorias = Genotipo::where('categoria', 'like', '%'. $request->buscar . '%')->paginate(25);


      $title = "categorias buscando: " . $request->buscar;
      return view('categorias.index', ['categorias' => $categorias, 'title' => $title ]);

    }



  public function search(Request $request){
    $term = $request->term;

    //  echo $term;
    //  die;

    $datos = Genotipo::where('categoria', 'like', '%'. $term . '%')->get();
    $adevol = array();
    if (count($datos) > 0) {
      foreach ($datos as $dato)
      {
        $adevol[] = array(
          'id' => $dato->id,
          'value' => $dato->categoria,
        );
      }
    } else {
      $adevol[] = array(
        'id' => 0,
        'value' => 'no hay coincidencias para ' .  $term
      );
    }
    return json_encode($adevol);
  }




  public function show($id)
  {

    $request = new Request([
      'id' => $id,
    ]);

    $validator = Validator::make($request->all(), [
      'id' => 'required|exists:categorias,id',
    ]);

    if ($validator->fails()) {
      foreach($validator->messages()->getMessages() as $field_name => $messages) {
        foreach($messages AS $message) {
          $errors[] = $message;
        }
      }
      return redirect()->back()->with('errors', $errors)->withInput();
      die;
    }

    $categoria = Genotipo::find($id);
    $title='Genotipo ver';
    return view('categorias.show', ['categoria' => $categoria, 'title' => $title]);

  }




}
