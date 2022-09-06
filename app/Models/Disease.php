<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    //
    public function alerts()
{

  return $this->hasMany(Alert::class);



}
/*public function kemri(){
  return $this->hasManyThrough(Alert::class,Kemriresponse::class);
}*/
}
