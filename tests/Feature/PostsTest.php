<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    public function test_can_see_a_post()
    {
        factory(Post::class)->create([
            'title' => "Hi! I'm post",
        ]);

        $response = $this->get('/post');
        $response->assertSeeText("Hi! I'm a post");
    }
}
