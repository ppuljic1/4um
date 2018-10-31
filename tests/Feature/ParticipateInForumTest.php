<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class ParticipateInForumTest extends TestCase
{

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads() 
    {

        // Create user and Authenticate user
        $this->signIn();

        // Thread
        $thread = create('App\Thread');

        // User adds a reply to the thread
        $reply = make('App\Reply');
        $this->post($thread->path() . '/replies', $reply->toArray());

        // Reply should be visible on the page
        $this->get($thread->path())
            ->assertSee($reply->body);

    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        // Create user and Authenticate user
        $this->withExceptionHandling()->signIn();

        // Thread
        $thread = create('App\Thread');

        // User adds a reply to the thread
        $reply = make('App\Reply', ['body'=>null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');

    } 
}
