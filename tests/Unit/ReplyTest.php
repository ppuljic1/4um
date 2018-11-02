<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    
    /** @test */
    public function it_has_an_owner() 
    {

        // Create reply
        $reply = factory('App\Reply')->create();

        // Check if reply->owner is instance of user
        $this->assertInstanceOf('App\User', $reply->owner);  

    }

}
