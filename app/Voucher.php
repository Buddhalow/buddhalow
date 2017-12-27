<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{

    public $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'name'];
}
