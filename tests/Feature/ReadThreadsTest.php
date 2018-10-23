<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadsTest extends TestCase
{

    use RefreshDatabase;

    public function setUp() 
    {
        parent::setUp();

        // Create a thread
        $this->thread = factory('App\Thread')->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {  
        // When we visit threads landing page we should se at least one title
        $this->get('/threads')
            ->assertSee($this->thread->title);

    }

    /** @test */
    public function a_user_can_read_a_single_thread()
    {  
        // When we visit specific thread we should see its title
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
        
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread() 
    {
        // Create the reply
        $reply = factory('App\Reply')
            ->create(['thread_id' => $this->thread->id]);

        // When we wisit a thread page we should see the replies
        $this->get($this->thread->path())
            ->assertSee($reply->body);

    }
}
