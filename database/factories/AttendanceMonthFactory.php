<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\AttendanceMonth;
use Faker\Generator as Faker;

function getEmployee()
{
    return App\Model\Employee::pluck('id')->toArray();
}

$factory->define(AttendanceMonth::class, function (Faker $faker) {
    return [
        'hours' => $faker->randomDigit,
        'month' => $faker->date(),
        'employee_id' => $faker->randomElement(getEmployee()),
    ];
});
