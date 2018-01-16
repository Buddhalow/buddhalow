<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\OpportunityState;

class Opportunity extends Model
{
    public static function boot() {
        self::updated(function ($model) {
            $state = new OpportunityState;
            $state->opportunity_id = $model->slug;
            $state->probability = $model->probability;
            $state->status_code = $model->status_code;
            $state->time = $model->time;
            $state->save();
        });
    }
    public function status() {
        return $this->belongsTo('App\Status', 'status_code', 'code');
    }
}
