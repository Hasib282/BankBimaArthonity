<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction_Mains_Temp extends Model
{
    protected $connection = 'mysql_second';

    protected $guarded = [];
    
    public $timestamps = false;

    public function User(){
        return $this->belongsTo(User_Info::class,'tran_user','user_id');
    }

    public function Location(){
        return $this->belongsTo(Location_Info::class,'loc_id','id');
    }

    public function Withs(){
        return $this->belongsTo(Transaction_With::class,'tran_type_with','id');
    }


    public function Store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }
}
