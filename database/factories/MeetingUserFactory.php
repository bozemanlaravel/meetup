<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MeetingUser;
use App\User;
use App\Meeting;
use Faker\Generator as Faker;

$factory->define(MeetingUser::class, function (Faker $faker) {
    return [
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'meeting_id' => function() {
            return factory(Meeting::class)->create()->id;
        },
        'attending' => false,
    ];
});
