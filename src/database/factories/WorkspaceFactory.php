<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Workspace;
use Faker\Generator as Faker;

$factory->define(Workspace::class, function (Faker $faker) {
    return [
        'title' => $faker->company
    ];
});
