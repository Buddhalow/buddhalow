<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roaming extends Model
{
    public function activites() {
        return $this->belongsToMany('App\Model\Activity')->withPivot('dimension')->withTimestamps();
    }
}
