<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\PostComment::class, function (Faker $faker) {
    $post = \App\Post::pluck('id')->toArray();
    $comment = \App\Comment::pluck('id')->toArray();
    return [
        'id_post' => $post,
        'id_comment' => $comment
    ];
});
