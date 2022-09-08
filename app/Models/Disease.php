<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    //
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    public function alerts()
{

  return $this->hasMany(Alert::class);



}
public function kemri()
{
  return $this->hasManyDeepFromRelations($this->alerts(),(new Alert())->kemri());
}
}
