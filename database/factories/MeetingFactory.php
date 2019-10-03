<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Meeting;
use Faker\Generator as Faker;

$factory->define(Meeting::class, function (Faker $faker) {
    return [
        'organizer_id' => function () {
            return factory(User::class)->create()->id;
        },
        'name' => 'test name',
        'description' => 'test description',
        'start' => now(),
        'end' => now()->addHour(),
        'location_name' => 'test location name',
        'location_address' => 'test address',
        'location_url' => 'test url',
    ];
});
