<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\WorkspaceApiKey;
use Faker\Generator as Faker;

$factory->define(WorkspaceApiKey::class, function (Faker $faker) {
    return [
        'title' => $faker->city,
        'api_key' => $faker->uuid,
        'is_active' => true,
    ];
})->state(WorkspaceApiKey::class, 'active', [
    'active' => true
])->state(WorkspaceApiKey::class, 'inactive', [
    'active' => false
]);
