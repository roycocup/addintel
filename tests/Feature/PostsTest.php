<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;

class PostsTest extends TestCase
{
    public function test_can_see_a_post()
    {
        factory(Post::class)->create([
            'title' => "Hi! Im a post",
        ]);

        $response = $this->get('/post');
        $response->assertSeeText("Hi! Im a post");
    }

    public function test_can_see_multiple_posts_in_created_order()
    {
        $post2 = factory(Post::class)->create([
            'title' => "... post 2 ...", 
            'created_at' => Carbon::parse('21-01-2019 20:52:00')
        ]);
        $post1 = factory(Post::class)->create([
            'title' => "Lorem ipsum dolor post 1 ...", 
            'created_at' => Carbon::parse('20-01-2019 20:52:00')
        ]);
        $post3 = factory(Post::class)->create([
            'title' => ".. post 3 ...", 
            'created_at' => Carbon::parse('22-01-2019 20:52:00')
        ]);

        $response = $this->get('/post');
        $response->assertSeeTextInOrder([
            "Lorem ipsum dolor post 1 ...", 
            "... post 2 ...", 
            ".. post 3 ...",
        ]);
    }

    public function test_a_post_has_an_associated_user()
    {
        $user = factory(User::class)->create([
            'name' => 'Paul Athreides',
            'email' => 'p.athreides@arrakis.du',
        ]);
        $post = factory(Post::class)->create([
            'title' => 'The sleeper has awaken',
            'user_id' => $user,
        ]);
        
        $this->assertEquals('Paul Athreides', $post->user->name);
        $this->assertEquals('p.athreides@arrakis.du', $post->user->email);
    }


    public function test_can_see_posts_with_authors_names()
    {
        $user = factory(User::class)->create([
            'name' => 'Paul Athreides',
            'email' => 'p.athreides@arrakis.du',
        ]);
        $post = factory(Post::class)->create([
            'title' => 'The sleeper has awaken!',
            'user_id' => $user,
        ]);

        $response = $this->get('/post');
        $response->assertSeeText('The sleeper has awaken! -- Paul Athreides');
    }
}
