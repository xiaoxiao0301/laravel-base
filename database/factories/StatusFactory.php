<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Status;

$factory->define(Status::class, function (Faker $faker) {
    $dateTime = $faker->date . ' ' . $faker->time;
    return [
        'content' => $faker->text(),
        'created_at' => $dateTime,
        'updated_at' => $dateTime,
    ];
});
