<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ShareState;

class Share extends Model
{
    public static function boot()
    {
      // before save code 
        self::updating(function ($model) {
          $share_state = new ShareState;
          $share_state->previous_qi = $model->getOriginal('qi');
          $q1 = ($model->qi - $share_state->previous_qi);
          if ($q1 >0 && $model->previous_qi > 0) {
            $share_state->percent_change = ($q1 / $model->previous_qi) * 100;
          } else {
            $share_state->percent_change = 100;
          }
          $share_state->share_id = $model->id;
          $share_state->qi = $model->qi;
          $share_state->quote = $model->quota;
          $share_state->time = new \DateTime;
          $share_state->entity_id = $model->entity_id;
          $share_state->save();
          
          // after save code
      });
    }
}
