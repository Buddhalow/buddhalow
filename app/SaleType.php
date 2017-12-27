<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleType extends Model
{
    public $table = 'sale_types';
    public $fillable = ['name', 'slug'];
    //
}
