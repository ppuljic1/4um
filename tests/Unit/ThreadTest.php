<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    protected $thread;

    use RefreshDatabase;

    public function setUp() 
    {
        parent::setUp();

        // Create a thread
        $this->thread = factory('App\Thread')->create();
    }


    /** @test */
    public function it_has_replies() 
    {

        // Check that thread has replies
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);

    }

    /** @test */
    public function it_has_a_creator() 
    {
        
        // Check that thread has a creator(user who posted the thread)
        $this->assertInstanceOf('App\User', $this->thread->creator);

    }

    /** @test */
    public function it_can_add_a_reply() 
    {

        // Create a reply
        $this->thread->addReply([
            'body'      =>  'Foobar',
            'user_id'   =>  1
        ]);

        // A thread should have only 1 reply
        $this->assertCount(1, $this->thread->replies);


    }


}
