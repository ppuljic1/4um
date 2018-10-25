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

        $this->post('/threads', $thread->toArray());

        // Visit thread page and we should see the new thread
        $this->get($thread->path())
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

}
