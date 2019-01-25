<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;
use App\Comment;


class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Comment::class, 50)->create([
            'user_id' => factory(User::class)->create(),
            'post_id' => factory(Post::class)->create(),
        ]);
    }
}
