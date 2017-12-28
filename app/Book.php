<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    public $fillable = ['name', 'isbn', 'description', 'book_type_id', 'release_date'];
}
