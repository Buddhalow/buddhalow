<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Share;
use App\EntityState;

class Entity extends Model
{
    public static function boot() {
        self::updating(function ($model) {
            // before save code 
            $model->previous_qi = $model->getOriginal('qi');
            
            $entity_state = new EntityState;
            $entity_state->previous_qi = $model->previous_qi;
            $entity_state->entity_id = $model->slug;
            $entity_state->qi = $model->qi;
            $q1 = ($model->qi - $entity_state->previous_qi);
            if ($q1 != 0 && $model->previous_qi != 0) {
                $entity_state->percent_change = ($q1 / $model->previous_qi) * 100;
                
            } else {
                $entity_state->percent_change = 100; 
            }
            $entity_state->time = new \DateTime;
           
            // after save code
            $shares = Share::where(array('owner_id' => $model->id))->get();
            foreach($shares as $share) {
                
                $share->qi = $model->qi * ($share->quota / $model->shares);  
              
                $share->save();
            } 
            $entity_state->save();
        });
    }
}
