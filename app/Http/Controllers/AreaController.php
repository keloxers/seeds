<?php

namespace App\Http\Controllers;

use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Http\Request;
use Validator;
use Bouncer;
use App\Manejo;
use App\Area;

use Carbon\Carbon;

class AreaController extends Controller
{

  public function index($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $manejo = Manejo::find($id);
    $areas = Area::where('manejos_id',$id)->paginate(25);


    $fecha = new Carbon($manejo->fecha);




    $title = "manejo: " . $fecha->format('d/m/Y') . ', ' . $manejo->aplicacions->aplicacion;
    return view('areas.index', ['manejo' => $manejo, 'areas' => $areas, 'title' => $title ]);

  }



    public function create($id)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $manejo = Manejo::find($id);

      $title = "Crear area en manejo:";
      return view('areas.create', ['manejo' => $manejo, 'title' => $title]);
    }



    public function store(Request $request)
    {
      if (Bouncer::cannot('Configuracion')) {
        $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
        return redirect()->back()->with('errors', $errors)->withInput();
      }

      $validator = Validator::make($request->all(), [
        'manejos_id' => 'required|exists:manejos,id',
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


      $area = new Area;
      $area->manejos_id = $request->manejos_id;

      $area->desdelinea = $request->desdelinea;
      $area->hastalinea = $request->hastalinea;
      $area->desdeposicion = $request->desdeposicion;
      $area->hastaposicion = $request->hastaposicion;

      $area->save();
      return redirect('manejos/' . $request->manejos_id . '/areas');

    }





  public function edit($id)
  {

    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }

    $area = Area::find($id);
    $title = "Area Editar";
    return view('areas.edit', ['area' => $area, 'title' => $title ]);
  }



  public function update(Request $request, $id)
  {
    if (Bouncer::cannot('Configuracion')) {
      $errors[] = 'No tiene autorizacion para ingresar a este modulo.';
      return redirect()->back()->with('errors', $errors)->withInput();
    }


    $validator = Validator::make($request->all(), [
      'areas_id' => 'required|unique:areas,id,'.$id . '|max:125',

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



          $area = Area::find($id);
          $manejos_id = $area->manejos_id;
          $area->desdelinea = $request->desdelinea;
          $area->hastalinea = $request->hastalinea;
          $area->desdeposicion = $request->desdeposicion;
          $area->hastaposicion = $request->hastaposicion;

          $area->save();

          return redirect('/manejos/' . $manejos_id . '/areas');





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
      'id' => 'required|exists:areas,id',
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

    $area = Area::find($id);
    $manejos_id = $area->manejos_id;
    $area->delete();
    return redirect('/manejos/' . $manejos_id . '/areas');


  }




    public function finder(Request $request){

      $areas = Area::where('categoria', 'like', '%'. $request->buscar . '%')->paginate(25);


      $title = "areas buscando: " . $request->buscar;
      return view('areas.index', ['areas' => $areas, 'title' => $title ]);

    }



  public function search(Request $request){
    $term = $request->term;

    //  echo $term;
    //  die;

    $datos = Area::where('areas', 'like', '%'. $term . '%')->get();
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
      'id' => 'required|exists:areas,id',
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

    $area = Area::find($id);
    $title='area ver';
    return view('categorias.show', ['area' => $area, 'title' => $title]);

  }




}
