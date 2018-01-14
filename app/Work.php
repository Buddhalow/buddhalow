<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    public function books() {
        return $this->belongsToMany('App\Book', 'work_id');
    }
    public $fillable = ['isbn', 'name', 'description', 'image_url'];
}
