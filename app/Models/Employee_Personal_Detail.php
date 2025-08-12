<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee_Personal_Detail extends Model
{
    protected $connection = 'mysql_second';

    protected $guarded = [];

    public function User(){
        return $this->belongsTo(User_Info::class,'emp_id','user_id');
    }

    public function Department(){
        return $this->belongsTo(Department::class,'department','id');
    }

    public function Location(){
        return $this->belongsTo(Location_Info::class,'location_id','id');
    }

    public function Designation(){
        return $this->belongsTo(Designation::class,'designation','id');
    }
    
    public function personalDetail()
    {
        return $this->belongsTo(Employee_Personal_Detail::class, 'emp_id', 'employee_id');
    }
}
