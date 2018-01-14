<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Aqtivity;

class Roaming extends Model
{
    public function aqtivities() {
        
        return $this->hasMany(Aqtivity::class);
    }
    public $incrementing = false;
    public $fillable = ['time'];
}
