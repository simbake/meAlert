<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kemriresponse extends Model
{
    //
    public function alert(){
      return $this->belongsTo(Alert::class);
    }
}
