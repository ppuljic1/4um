<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class CreateThreadsTest extends TestCase
{

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        
        // Authenticated user
        $this->signIn();

        // Hit the endpoint to create a new thread
        $thread = make('App\Thread');

        $response = $this->post('/threads', $thread->toArray());

        // Visit thread page and we should see the new thread
        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }

    /** @test */
    public function guests_cannot_see_the_create_thread_page() 
    {

        $this->withExceptionHandling()
            ->get('/threads/create')
            ->assertRedirect('/login');

    }

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->publishThread( ['title' => null] )
            ->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->publishThread( ['body' => null] )
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function a_thread_requires_a_valid_channel()
    {
        factory('App\Channel', 2)->create();

        $this->publishThread( ['channel_id' => null] )
            ->assertSessionHasErrors('channel_id');

        $this->publishThread( ['channel_id' => 999] )
            ->assertSessionHasErrors('channel_id');
    }


    /** Helper method */
    public function publishThread($overrides = [])
    {

        $this->withExceptionHandling()->signIn();

        $thread = make('App\Thread', $overrides);

        return $this->post('/threads', $thread->toArray());

    }

}
