<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public $primaryKey = 'id';
    public $incrementing = false;
    public $fillable = ['name'];
}
