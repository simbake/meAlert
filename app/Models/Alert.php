<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    //
    public function facility(){
  return $this->belongsTo(Facility::class);
}
public function disease(){
  return $this->hasOne(Disease::class);
}
public function user(){
  return $this->belongsTo(User::class);
}
public function respond()
{

return $this->hasOne(Response::class);

}
public function kemri()
{

return $this->hasOne(Kemriresponse::class);

}
}
