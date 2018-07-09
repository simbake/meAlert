<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    //
    public function alerts()
{

  return $this->hasMany(Alert::class);



}
public function subcounty(){
  return $this->belongsTo(Subcounty::class);
}
public function county(){
  return $this->belongsTo(County::class);
}
}
