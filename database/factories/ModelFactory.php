<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Sales::class, function (Faker $faker) {
    return [
        'date' => \Carbon\Carbon::now(),
        'employee_id' => factory(\App\Employees::class)->create()->id ,
        'customer_id' => factory(\App\Customers::class)->create()->id,
        'product_id' => factory(\App\Products::class)->create()->id,
        'date' => $faker->date('Y-m-d'),
    ];
});

$factory->define(App\Customers::class, function (Faker $faker) {
    return [];
});

$factory->define(App\Products::class, function (Faker $faker) {
    return [];
});


$factory->define(App\Employees::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
