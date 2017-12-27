<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorType extends Model
{
    public $fillable = ['name', 'id', 'slug'];
}
 