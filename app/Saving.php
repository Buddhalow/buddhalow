<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saving extends Model
{
    protected $fillable = ['name', 'description', 'amount'];
}
