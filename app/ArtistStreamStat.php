<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ArtistStreamStat extends Model
{
    public $fillable = ['followers', 'streams', 'artist_id', 'external_id', 'external_artist_id'];
    
}
