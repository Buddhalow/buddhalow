<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stores';
    
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     **/
    protected $fillable = ['name', 'slug'];

    
}
