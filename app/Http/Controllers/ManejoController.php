<?php

namespace App\Http\Controllers;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use Validator;
use Bouncer;
use App\Huerta;
use App\Manejo;

use Carbon\Carbon;


class ManejoController extends Controller
{

  public function index($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $huerta = Huerta::find($id);
    $manejos = Manejo::where('huertas_id',$id)->paginate(25);
    $title = "Huerta: " . $huerta->huerta;
    return view('manejos.index', ['huerta' => $huerta, 'manejos' => $manejos, 'title' => $title ]);

  }



    public function create($id)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $huerta = Huerta::find($id);

      $title = "Crear manejo en huerta:";
      return view('manejos.create', ['huerta' => $huerta, 'title' => $title]);
    }



    public function store(Request $request)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $validator = Validator::make($request->all(), [
        'huertas_id' => 'required|exists:huertas,id',
        'aplicacions_id' => 'required|exists:aplicacions,id',
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

      $manejo = new manejo;
      $manejo->huertas_id = $request->huertas_id;
      $manejo->aplicacions_id = $request->aplicacions_id;
      $manejo->fecha = $date;
      $manejo->activo = $activo;

      $manejo->save();
      return redirect('huertas/' . $request->huertas_id . '/manejos');


    }





  public function edit($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $manejo = Manejo::find($id);
    $title = "Manejo Editar";
    return view('manejos.edit', ['manejo' => $manejo, 'title' => $title ]);
  }



  public function update(Request $request, $id)
  {
    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $validator = Validator::make($request->all(), [
      'manejo' => 'required|unique:manejos,id,'.$id . '|max:125',

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

          $manejo = Manejo::find($id);
          $huertas_id = $manejo->huertas_id;
          $manejo->aplicacions_id = $request->aplicacions_id;
          $manejo->fecha = $date;
          $manejo->activo = $activo;

          $manejo->save();

          return redirect('/huertas/' . $huertas_id . '/manejos');



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
      'id' => 'required|exists:manejos,id',
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

    $manejo = Manejo::find($id);
    $huertas_id = $manejo->huertas_id;
    $manejo->delete();
    return redirect('/huertas/' . $huertas_id . '/manejos');


  }




    public function finder(Request $request){

      $manejos = Manejo::where('categoria', 'like', '%'. $request->buscar . '%')->paginate(25);


      $title = "Manejos buscando: " . $request->buscar;
      return view('manejos.index', ['manejos' => $manejos, 'title' => $title ]);

    }



  public function search(Request $request){
    $term = $request->term;

    //  echo $term;
    //  die;

    $datos = manejo::where('manejos', 'like', '%'. $term . '%')->get();
    $adevol = array();
    if (count($datos) > 0) {
      foreach ($datos as $dato)
      {
        $adevol[] = array(
          'id' => $dato->id,
          'value' => $dato->id,
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
      'id' => 'required|exists:manejos,id',
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

    $manejo = Manejo::find($id);
    $title='manejo ver';
    return view('categorias.show', ['manejo' => $manejo, 'title' => $title]);

  }




}
