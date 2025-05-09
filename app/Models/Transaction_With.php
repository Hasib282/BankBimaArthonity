<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction_With extends Model
{
    protected $connection = 'mysql_second';

    protected $guarded = [];

    public $timestamps = false;

    public function Role(){
        return $this->belongsTo(Role::class,'user_role','id');
    }

    public function Type(){
        return $this->belongsTo(Transaction_Main_Head::class,'tran_type','id');
    }
}
