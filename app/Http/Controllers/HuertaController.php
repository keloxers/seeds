<?php

namespace App\Http\Controllers;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use Validator;
use Bouncer;
use App\Huerta;
use Carbon\Carbon;

class HuertaController extends Controller
{

  public function index()
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $huertas = Huerta::paginate(25);
    $title = "Huertas";
    return view('huertas.index', ['huertas' => $huertas, 'title' => $title ]);

  }



    public function create()
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $title = "Crear huerta";
      return view('huertas.create', ['title' => $title]);
    }



    public function store(Request $request)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $validator = Validator::make($request->all(), [
        'huerta' => 'required|max:125',
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

      $huerta = new Huerta;
      $huerta->huerta = $request->huerta;
      $huerta->lineas = $request->lineas;
      $huerta->posiciones =  $request->posiciones;
      $huerta->fechacreacion =  $date;
      $huerta->activo = $activo;
      $huerta->save();
      return redirect('/huertas');



    }



  public function edit($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $huerta = Huerta::find($id);
    $title = "Huerta Editar";
    return view('huertas.edit', ['huerta' => $huerta, 'title' => $title ]);
  }



  public function update(Request $request, $id)
  {
    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $validator = Validator::make($request->all(), [
      'huerta' => 'required|max:125',

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

    $huerta = Huerta::find($id);
    $huerta->huerta = $request->huerta;
    $huerta->lineas = $request->lineas;
    $huerta->posiciones =  $request->posiciones;
    $huerta->fechacreacion =  $date;
    $huerta->activo = $activo;
    $huerta->save();
    return redirect('/huertas');

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
      'id' => 'required|exists:huertas,id',
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

    $huerta = Huerta::find($id);
    $huerta->delete();
    return redirect('/huertas/');


  }




    public function finder(Request $request){

      $huertas = Huerta::where('huerta', 'like', '%'. $request->buscar . '%')->paginate(25);


      $title = "huerta buscando: " . $request->buscar;
      return view('huertas.index', ['huertas' => $huertas, 'title' => $title ]);

    }



  public function search(Request $request){
    $term = $request->term;

    //  echo $term;
    //  die;

    $datos = Huerta::where('huerta', 'like', '%'. $term . '%')->get();
    $adevol = array();
    if (count($datos) > 0) {
      foreach ($datos as $dato)
      {
        $adevol[] = array(
          'id' => $dato->id,
          'value' => $dato->huerta,
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
      'id' => 'required|exists:huertas,id',
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

    $huerta = Huerta::find($id);
    $title='Huerta';
    return view('huertas.show', ['huerta' => $huerta, 'title' => $title]);

  }




}
