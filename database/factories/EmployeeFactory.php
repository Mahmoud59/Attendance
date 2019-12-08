<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Employee;
use Faker\Generator as Faker;

function getUser()
{
    return App\Model\User::pluck('id')->toArray();
}

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'pin_code' => $faker->randomDigit,
        'user_id' => $faker->randomElement(getUser()),
    ];
});
