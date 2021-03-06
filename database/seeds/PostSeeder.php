<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Comment;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        factory(App\Post::class, 50)->create([
            'user_id' => factory(User::class)->create(),
        ]);
    }
}
