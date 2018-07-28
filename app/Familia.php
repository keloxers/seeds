<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{

  protected $table = 'Familias';


  public function origens()
  {
      return $this->belongsTo('App\Origen');
  }



}
