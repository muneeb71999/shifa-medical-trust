<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
        // select * from users where patients.user_id = user.id
    }

    public function doctor()
    {
        return $this->belongsTo(Employees::class);
        // select * from employees where patients.doctor_id = employees.id
    }
}
