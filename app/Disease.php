<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    //
    public function alerts()
{

  return $this->hasMany(Alert::class);



}
}
