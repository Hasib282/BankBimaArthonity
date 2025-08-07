<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advance_Salary extends Model
{
    protected $connection = 'mysql_second';
    
    protected $guarded = [];

    public $timestamps = false;

    public function Employee(){
        return $this->belongsTo(User_Info::class,'emp_id','user_id');
    }
}
