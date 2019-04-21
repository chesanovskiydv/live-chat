<?php

use App\Models\User;
use App\Models\UserType;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/* @var $factory \Illuminate\Database\Eloquent\Factory */
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
        'user_type_id' => function () {
            return UserType::where(['name' => UserType::CUSTOMER])->first()->getKey();
        },
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10),
    ];
})->state(User::class, 'super_user', [
    'user_type_id' => function () {
        return UserType::where(['name' => UserType::SUPER_ADMIN])->first()->getKey();
    }
])->state(User::class, 'customer', [
    'user_type_id' => function () {
        return UserType::where(['name' => UserType::CUSTOMER])->first()->getKey();
    }
]);
