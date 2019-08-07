<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Comment::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'email' => preg_replace('/@example\..*/', '@lara-test.loc', $faker->unique()->safeEmail),
        'comment' => $faker->text,
        'approved' => $faker->randomElement(($array = array ('1','0'))),
        'published_at' => \Carbon\Carbon::now(),
    ];
});
