<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

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


}
