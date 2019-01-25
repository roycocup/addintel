<?php

use Faker\Generator as Faker;
use App\Comment;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->paragraph(1),
    ];
});
