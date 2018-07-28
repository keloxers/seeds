<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{

  protected $table = 'familias';


  public function origens()
  {
      return $this->belongsTo('App\Origen');
  }



}
