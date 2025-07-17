<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporter_Portal extends Model
{
    protected $connection = 'mysql_second';
    
    protected $guarded = [];

    public $timestamps = false;
}
