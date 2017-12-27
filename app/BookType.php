<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'book_types';
    
    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    
}
