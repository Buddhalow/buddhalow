<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{

    public $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'name'];
}
