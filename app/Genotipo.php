<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genotipo extends Model
{

  protected $table = 'genotipos';

  public function maestros()
  {
      return $this->belongsTo('App\Maestro');
  }



}
