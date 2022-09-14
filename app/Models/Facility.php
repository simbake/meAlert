<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    //
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
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
public function diseases(){

  return $this->hasManyDeepFromRelations($this->alerts(),(new Alert())->disease());
}

}
