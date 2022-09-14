<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kemriresponse extends Model
{
    //
    use \Znck\Eloquent\Traits\BelongsToThrough;
    public function alert(){
      return $this->belongsTo(Alert::class);
    }
    public function disease(){
      return $this->belongsToThrough(Disease::class, Alert::class);
      //return $this->alert->disease();
    }
}
