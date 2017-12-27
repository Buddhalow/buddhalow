<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BookAuthor extends Pivot
{ 
    public $table = 'book_authors';
    public function books() {
        return $this->belongsToMany('App\Author')->using('App\BookAuthor');
    }
}
