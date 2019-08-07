<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\UserPost::class, function (Faker $faker) {
    $user = \App\User::pluck('id')->toArray();
    $post = \App\Post::pluck('id')->toArray();
    return [
        'id_user' => $faker->randomElement($user),
        'id_post' => $faker->randomElement($post)
    ];
});
