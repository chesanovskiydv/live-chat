<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'text' => $faker->realText(),
        'read_at' => null
    ];
})->state(Message::class, 'unread', [
    'read_at' => null
])->state(Message::class, 'read', function (Faker $faker) {
    return [
        'read_at' => $faker->dateTimeBetween('-2 month')
    ];
});
