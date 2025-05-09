<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $connection = 'mysql';

    protected $guarded = [];
    
    public $timestamps = false;


    public function permissions(){
        return $this->belongsToMany(Permission_Head::class, 'permission__roles', 'role_id', 'permission_id', 'id', 'id');
    }
}
