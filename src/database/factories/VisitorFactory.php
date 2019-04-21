<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Visitor;
use Faker\Generator as Faker;

$factory->define(Visitor::class, function (Faker $faker) {
    return [
        'user_id' => $faker->uuid,
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'custom_attributes' => null,
    ];
});
