<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement_Info extends Model
{
    protected $connection = 'mysql_second';
    
    protected $guarded = [];

    public $timestamps = false;

    
    public function transaction(){
        return $this->belongsTo(Transaction_Detail::class,'tran_id','tran_id');
    }

 
    


}
