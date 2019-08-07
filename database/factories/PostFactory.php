<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator as Faker;

$factory->define(\App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6,true),
        'description' => $faker->text(200),
        'image' => $faker->imageUrl($width = 640, $height = 480, 'cats'),
        'slug' => $faker->slug(3),
        'approved' => $faker->randomElement(($array = array ('1','0'))),
        'published_at' => date("Y-m-d H:i:s"),
    ];
});
