<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttendanceMonth extends Model
{
    protected $fillable = [
        'hours', 'month', 'employee_id'
    ];
}
