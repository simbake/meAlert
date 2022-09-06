<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','county_id','subcounty_id','county_id', 'username', 'email', 'mobile','access_level', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function alerts()
{

  return $this->hasMany(Alert::class);



}
public function response()
{

return $this->hasMany(Response::class);



}

public function county(){
  return $this->belongsTo(County::class);
}

public function subcounty(){
  return $this->belongsTo(Subcounty::class);
}

public function publish(Alert $alert){
  $this->alerts()->save($alert);
}
}
