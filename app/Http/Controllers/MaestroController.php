<?php

namespace App\Http\Controllers;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use Validator;
use Bouncer;
use App\Categoria;
use App\Especie;
use App\Maestro;


class MaestroController extends Controller
{

  public function index($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $especie = Especie::find($id);
    $maestros = Maestro::where('especies_id',$id)->paginate(25);
    $title = "especie: " . $especie->especie;
    return view('maestros.index', ['especie' => $especie, 'maestros' => $maestros, 'title' => $title ]);

  }



    public function create($id)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $especie = Especie::find($id);

      $title = "Crear maestros para especie:";
      return view('maestros.create', ['especie' => $especie, 'title' => $title]);
    }



    public function store(Request $request)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $validator = Validator::make($request->all(), [
        'especies_id' => 'required|exists:especies,id',
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

      $maestro = new Maestro;
      $maestro->especies_id = $request->especies_id;
      $maestro->maestro = $request->maestro;
      $maestro->activo = $activo;
      $maestro->save();
      return redirect('maestros/' . $request->especies_id . '/create');




    }





  public function edit($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $maestro = Maestro::find($id);
    $title = "Maestro Editar";
    return view('maestros.edit', ['maestro' => $maestro, 'title' => $title ]);
  }



  public function update(Request $request, $id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }



    $validator = Validator::make($request->all(), [
      'maestros_id' => 'required|unique:maestros,id,'.$id . '|max:125',
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

    $maestro = Maestro::find($id);
    $especies_id = $maestro->especies_id;
    $maestro->maestro = $request->maestro;
    $maestro->activo = $activo;
    $maestro->save();
    return redirect('/especies/' . $especies_id . '/maestros');

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
      'id' => 'required|exists:maestros,id',
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

    $maestro = Maestro::find($id);
    $especies_id = $maestro->$especies_id;
    $maestro->delete();
    return redirect('especies/' . $especies_id . '/maestros');


  }




    public function finder(Request $request){
      $maestros = Maestro::where('maestro', 'like', '%'. $request->buscar . '%')->paginate(35);
      $title = "Maestro buscando: " . $request->buscar;
      return view('maestros.index', ['maestros' => $maestros, 'title' => $title ]);

    }



  public function search(Request $request){
    $term = $request->term;

    //  echo $term;
    //  die;

    $datos = Maestro::where('maestro', 'like', '%'. $term . '%')->get();
    $adevol = array();
    if (count($datos) > 0) {
      foreach ($datos as $dato)
      {
        $adevol[] = array(
          'id' => $dato->id,
          'value' => $dato->maestro,
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
      'id' => 'required|exists:maestros,id',
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

    $maestro = Maestro::find($id);
    $title='maestro ver';
    return view('maestros.show', ['maestro' => $maestro, 'title' => $title]);

  }




}
