<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use App\Comment;
use Tests\TestCase;
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

    public function test_posts_have_comments()
    {
        
        $post = factory(Post::class)->create([
            'title' => $this->faker->paragraph(1),
            'user_id' => factory(User::class)->create(),
        ]);

        $comments_user = factory(User::class)->create();
        
        // generate 3 comment string
        for($i=1; $i <= 3; $i++){
            $rndStr[] = \str_random(10);
        }

        $comment1 = factory(Comment::class)->create([
            'text' => $rndStr[0],
            'post_id' => $post,
            'user_id' => $comments_user,
        ]);

        $comment2 = factory(Comment::class)->create([
            'text' => $rndStr[2],
            'post_id' => $post,
            'user_id' => $comments_user,
        ]);

        $comment3 = factory(Comment::class)->create([
            'text' => $rndStr[1],
            'post_id' => $post,
            'user_id' => $comments_user,
        ]);

        $this->assertEquals($rndStr[0], $comment1->text);
        $this->assertEquals($rndStr[2], $comment2->text);
        $this->assertEquals($rndStr[1], $comment3->text);
    }
}
