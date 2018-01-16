<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\ShareState;

class EntityState extends Model
{
    public static function boot() {
        self::updating(function ($model) {
            $share_state = ShareState::where(array('entity_state_id' => $model->entity_state_id))->first();
            if ($share_state != null) {
                $share_state->time = $model->time;
                $share_state->save();
            }
        });
    }
}
