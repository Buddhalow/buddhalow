<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ChallengeState;

class Challenge extends Model
{
    public static function boot() {
        self::updating(function ($model) {
           $state = new ChallengeState;
           $state->challenge_id = $model->id;
           $state->time = new \DateTime;
           $state->progress = $model->progress;
           $state->status = $model->status; 
           $state->save();
        });
    }
}
