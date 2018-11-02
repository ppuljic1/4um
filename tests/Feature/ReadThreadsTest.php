<?php

namespace Tests\Feature;

use Tests\TestCase;

class ReadThreadsTest extends TestCase
{

    public function setUp() 
    {
        parent::setUp();

        // Create a thread
        $this->thread = create('App\Thread');
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
        $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

        // When we wisit a thread page we should see the replies
        $this->get($this->thread->path())
            ->assertSee($reply->body);

    }

    /** @test */
    public function a_user_can_filter_threads_acording_to_a_channel() 
    {
        $channel = create('App\Channel');
        $threadInChannel = create('App\Thread', ['channel_id'=>$channel->id]);
        $threadNotInChannel = create('App\Thread');

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);

    }


}
