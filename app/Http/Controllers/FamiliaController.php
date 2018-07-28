<?php

namespace App\Http\Controllers;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use Validator;
use Bouncer;
use App\Categoria;
use App\Especie;
use App\Familia;


class FamiliaController extends Controller
{

  public function index($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $especie = Especie::find($id);
    $familias = Familia::where('especies_id',$id)->paginate(25);
    $title = "Especie: " . $especie->especie;
    return view('familias.index', ['especie' => $especie, 'familias' => $familias, 'title' => $title ]);

  }



    public function create($id)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $especie = Especie::find($id);

      $title = "Crear familias para especie:";
      return view('familias.create', ['especie' => $especie, 'title' => $title]);
    }



    public function store(Request $request)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $validator = Validator::make($request->all(), [
        'especies_id' => 'required|exists:especies,id',
        'origens_id' => 'required|exists:origens,id',

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

      $familia = new Familia;
      $familia->especies_id = $request->especies_id;
      $familia->familia = $request->familia;
      $familia->origens_id = $request->origens_id;
      $familia->activo = $activo;
      $familia->save();
      return redirect('familias/' . $request->especies_id . '/create');




    }





  public function edit($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $familia = Familia::find($id);
    $title = "Familia Editar";
    return view('familias.edit', ['familia' => $familia, 'title' => $title ]);
  }



  public function update(Request $request, $id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }



    $validator = Validator::make($request->all(), [
      'familias_id' => 'required|unique:familias,id,'.$id . '|max:125',
      'origens_id' => 'required|exists:origens,id',

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

    $familia = Familia::find($id);
    $especies_id = $familia->especies_id;
    $familia->familia = $request->familia;
    $familia->origens_id = $request->origens_id;
    $familia->activo = $activo;
    $familia->save();
    return redirect('/especies/' . $especies_id . '/familias');

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
      'id' => 'required|exists:familias,id',
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

    $familia = Familia::find($id);
    $especies_id = $familia->especies_id;
    $familia->delete();
    return redirect('especies/' . $especies_id . '/familias');


  }




    public function finder(Request $request){
      $familias = Familia::where('familia', 'like', '%'. $request->buscar . '%')->paginate(35);
      $title = "familia buscando: " . $request->buscar;
      return view('familias.index', ['familias' => $familias, 'title' => $title ]);

    }



  public function search(Request $request){
    $term = $request->term;

    //  echo $term;
    //  die;

    $datos = Familia::where('familia', 'like', '%'. $term . '%')->get();
    $adevol = array();
    if (count($datos) > 0) {
      foreach ($datos as $dato)
      {
        $adevol[] = array(
          'id' => $dato->id,
          'value' => $dato->familia,
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
      'id' => 'required|exists:familias,id',
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

    $familia = Familia::find($id);
    $title='Familia ver';
    return view('familias.show', ['familia' => $familia, 'title' => $title]);

  }




}
