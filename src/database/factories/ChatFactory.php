<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Chat;
use Faker\Generator as Faker;

$factory->define(Chat::class, function (Faker $faker) {
    return [
        'visitor_unread_messages_count' => 0,
        'user_unread_messages_count' => 0,
    ];
});
