<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'check_in', 'check_out', 'day', 'employee_id'
    ];
}
