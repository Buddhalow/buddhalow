<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seed extends Model
{
    public $fillable = ['name', 'description', 'hash'];
}
