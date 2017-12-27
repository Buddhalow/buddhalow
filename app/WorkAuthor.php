<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class WorkAuthor extends Pivot
{
    public $table = 'work_authors';
}
