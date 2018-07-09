<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    //
    public function subcounties()
{

  return $this->hasMany(Subcounty::class);



}
public function alerts(){
  return $this->hasManyThrough(Alert::class,Facility::class);
}
public function user()
{

return $this->hasMany(User::class);

}
public function facility()
{

return $this->hasMany(Facility::class);

}
}
