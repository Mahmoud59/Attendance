<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Attendance;
use Faker\Generator as Faker;

function getEmployees()
{
    return App\Model\Employee::pluck('id')->toArray();
}

$factory->define(Attendance::class, function (Faker $faker) {
    return [
        'check_in' => $faker->time(),
        'check_out' => $faker->time(),
        'day' => $faker->randomDigit,
        'employee_id' => $faker->randomElement(getEmployees()),
    ];
});
