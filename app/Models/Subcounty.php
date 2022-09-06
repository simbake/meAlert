<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcounty extends Model
{
    //
    public function county(){
      return $this->belongsTo(County::class);
    }
    public function user()
    {

    return $this->hasMany(User::class);



    }
    public function alerts(){
      return $this->hasManyThrough(Alert::class,Facility::class);
    }
    public function facility()
    {

    return $this->hasMany(Facility::class);

    }
    public function alerts_subcounty(){
      return $this->hasManyThrough(Alert::class,Facility::class);
    }
}
