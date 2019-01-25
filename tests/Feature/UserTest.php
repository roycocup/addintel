<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\{User, Post, Comment};
use Illuminate\Support\Facades\Mail;
use App\Mail\UserDeleted;

class UserTest extends TestCase
{
    public function test_can_create_user()
    {
        $this->post('/user/new', [
            'name' => 'test user 1',
            'email' => 'example@rodderscode.co.uk',
            '_token' => csrf_token(),
        ])->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'email' => 'example@rodderscode.co.uk',
            'name' => 'test user 1',
        ]);
    }

    public function test_can_update_user()
    {
        $user = factory(User::class)->create([
            'id' => 1,
            'name' => 'initial name',
        ]);

        $response = $this->post('/user/1/update', [
            'name' => 'updated name',
            'email' => $user->email,
        ]);
        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'name' => 'updated name',
        ]);
    }


    public function test_can_delete_user()
    {
        $user = factory(User::class)->create(['id' => 1,]);

        $response = $this->delete('/user/1/delete')
            ->assertStatus(200);
    
        $this->assertDatabaseMissing('users', ['email' => $user->email,]);
    }

    public function test_deleting_user_cascades_to_posts_and_comments_authored()
    {
        $user = factory(User::class)->create(['id' => 1,]);
        $post = factory(Post::class)->create(['user_id' => $user,]);
        $comment = factory(Comment::class)->create([
            'user_id' => $user, 
            'post_id' => $post,
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);


        $response = $this->delete('/user/1/delete')->assertStatus(200);

        $this->assertDatabaseMissing('users', ['id' => $user->id,]);
        $this->assertDatabaseMissing('posts', ['id' => $post->id,]);
        $this->assertDatabaseMissing('comments', ['id' => $comment->id,]);
    }

    public function test_email_sent_to_deleted_user()
    {
        $user = factory(User::class)->create(['id' => 1,]);
        
        Mail::fake();
        Mail::assertNothingSent();
        
        $this->delete('/user/1/delete');

        Mail::assertSent(UserDeleted::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }

}
