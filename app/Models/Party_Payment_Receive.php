<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party_Payment_Receive extends Model
{
    protected $connection = 'mysql_second';

    protected $guarded = [];
    
    public $timestamps = false;

    public function User(){
        return $this->belongsTo(User_Info::class,'tran_user','user_id');
    }

    public function Head(){
        return $this->belongsTo(Transaction_Head::class,'tran_head_id','id');
    }


    public function Groupe(){
        return $this->belongsTo(Transaction_Groupe::class,'tran_groupe_id','id');
    }


    public function Location(){
        return $this->belongsTo(Location_Info::class,'loc_id','id');
    }


    public function Withs(){
        return $this->belongsTo(Transaction_With::class,'tran_type_with','id');
    }
}
