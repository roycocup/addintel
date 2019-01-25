<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends DuskTestCase
{
    public function test_can_see_a_list_of_posts()
    {
        $posts = factory(Post::class, 3)->create();

        $this->browse(function (Browser $browser)  use ($posts) {
            $browser->visit('/post')
                ->assertSee($posts[0]->title)
                ->assertSee($posts[1]->title)
                ->assertSee($posts[2]->title)
                ;
        });
    }
}
