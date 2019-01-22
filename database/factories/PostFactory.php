<?php

use App\Post;
use Faker\Generator as Faker;
use App\User;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->paragraph(1),
        'user_id' => factory(User::class)->create(),
    ];
});
