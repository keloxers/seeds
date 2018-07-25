<?php

namespace App\Http\Controllers;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use Validator;
use Bouncer;
use App\maestro;
use Carbon\Carbon;

class maestroController extends Controller
{

  public function index()
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $maestros = maestro::paginate(25);
    $title = "maestros";
    return view('maestros.index', ['maestros' => $maestros, 'title' => $title ]);

  }



    public function create()
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $title = "Crear maestro";
      return view('maestros.create', ['title' => $title]);
    }



    public function store(Request $request)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $validator = Validator::make($request->all(), [
        'maestro' => 'required|max:125',
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

      $date = $request->date;

      $dia = substr($date,0,2);
      $mes = substr($date,3,2);
      $anio = substr($date,6,4);

      $date = Carbon::createFromDate($anio, $mes, $dia)->setTime(0, 0, 0);



      $activo = 0;
      if ($request->activo=='on') { $activo = 1; }

      $maestro = new maestro;
      $maestro->maestro = $request->maestro;
      $maestro->lineas = $request->lineas;
      $maestro->posiciones =  $request->posiciones;
      $maestro->fechacreacion =  $date;
      $maestro->activo = $activo;
      $maestro->save();
      return redirect('/maestros');



    }





  public function edit($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $maestro = maestro::find($id);
    $title = "maestro Editar";
    return view('maestros.edit', ['maestro' => $maestro, 'title' => $title ]);
  }



  public function update(Request $request, $id)
  {
    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $validator = Validator::make($request->all(), [
      'maestro' => 'required|max:125',

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

    $date = $request->date;

    $dia = substr($date,0,2);
    $mes = substr($date,3,2);
    $anio = substr($date,6,4);

    $date = Carbon::createFromDate($anio, $mes, $dia)->setTime(0, 0, 0);

    $maestro = maestro::find($id);
    $maestro->maestro = $request->maestro;
    $maestro->lineas = $request->lineas;
    $maestro->posiciones =  $request->posiciones;
    $maestro->fechacreacion =  $date;
    $maestro->activo = $activo;
    $maestro->save();
    return redirect('/maestros');

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

    $maestro = maestro::find($id);
    $maestro->delete();
    return redirect('/maestros/');


  }




    public function finder(Request $request){

      $maestros = maestro::where('maestro', 'like', '%'. $request->buscar . '%')->paginate(25);


      $title = "maestro buscando: " . $request->buscar;
      return view('maestros.index', ['maestros' => $maestros, 'title' => $title ]);

    }



  public function search(Request $request){
    $term = $request->term;

    //  echo $term;
    //  die;

    $datos = maestro::where('maestro', 'like', '%'. $term . '%')->get();
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

    $maestro = maestro::find($id);
    $title='maestro';
    return view('maestros.show', ['maestro' => $maestro, 'title' => $title]);

  }




}
