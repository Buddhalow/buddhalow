<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Infection;

class Treatment extends Model
{
    protected $fillable = ['vaseline_gel_applied', 'amount', 'balance', 'terbinafine_gel_applied', 'loceryl_applied'];
    
    public static function boot() {
        self::created(function ($model) {
            $fungal_infection = Infection::where(array('code' => $model->fungal_infection_id))->first();
            $fungal_infection->balance += $model->amount;
            $model->balance = $fungal_infection->balance;
           
            $model->save();
        });
    }
}
