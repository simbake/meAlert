<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    //
    public function alert(){
      return $this->belongsTo(Alert::class);
    }
    public function user(){
      return $this->belongsTo(User::class);
    }
}
