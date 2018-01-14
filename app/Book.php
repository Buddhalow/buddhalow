<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function books() {
        return $this->belongsToMany('App\Book', 'parent_book_id');
    }
    //
    public $fillable = ['name', 'isbn', 'description', 'book_type_id', 'work_id', 'country', 'language', 'release_date', 'parent_book_id', 'image_url'];
}
