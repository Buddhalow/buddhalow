<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Opportunity extends Model
{
    public function status() {
        return $this->belongsTo('App\Status', 'status', 'code');
    }
}
