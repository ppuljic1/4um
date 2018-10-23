<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads() 
    {

        // Create user and Authenticate user
        $this->be(factory('App\User')->create());

        // Thread
        $thread = factory('App\Thread')->create();

        // User adds a reply to the thread
        $reply = factory('App\Reply')->create();
        $this->post($thread->path() . '/replies', $reply->toArray());

        // Reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);

    }
}
