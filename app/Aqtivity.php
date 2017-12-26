<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Aqtivity extends Model
{
    public function roamings() {
        return $this->belongsToMany('App\Model\Roaming');
    }
    
    protected $fillable = ['dimension'];
}
