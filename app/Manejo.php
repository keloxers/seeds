<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manejo extends Model
{

  protected $table = 'manejos';

  public function huertas()
  {
      return $this->belongsTo('App\Huerta');
  }

  public function aplicacions()
  {
      return $this->belongsTo('App\Aplicacion');
  }


}
