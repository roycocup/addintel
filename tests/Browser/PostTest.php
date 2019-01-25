<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Post;

class PostTest extends DuskTestCase
{
    
    public function test_can_see_a_list_of_posts()
    {
        factory(Post::class, 3)->create();

        $this->browse(function (Browser $browser) {
            $post1 =  Post::find(1);
            $browser->visit('/post')
            ->assertSee($post1->title);
                    
        });
    }
}
