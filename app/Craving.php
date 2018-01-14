<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Craving extends Model
{
    public $fillable = ['parse_id', 'status', 'action_id', 'food_id', 'status', 'toothbrush', 'cost', 'location'];
}
