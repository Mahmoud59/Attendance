<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Employee extends Authenticatable
{
	use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'pin_code', 'user_id'
    ];

}
