<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
    public $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['name'];
}
