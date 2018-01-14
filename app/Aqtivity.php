<?php

namespace App ;

use Illuminate\Database\Eloquent\Model;
use App\Sport;

class Aqtivity extends Model
{
    public function roaming() {
        return $this->belongsTo(Roaming::class);
    }
    public function facility() {
        return $this->belongsTo(Facility::class);
    }
    public function sport() {
        return $this->belongsTo(Sport::class);
    }
    
    
    protected $fillable = ['dimension_id', 'sport_id', 'facility_id', 'user_id', 'roaming_id'];
}
