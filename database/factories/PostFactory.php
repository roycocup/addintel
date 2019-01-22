<?php

use App\Post;
use Faker\Generator as Faker;
use App\User;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'user_id' => factory(User::class)->create(),
    ];
});
