<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;

class RepliesController extends Controller
{
    /**
     * Create a new RepliesController instance
     */
    public function __construct() 
    {

        $this->middleware('auth');

    }
    /**
     * Persist a new reply
     * 
     * @param $channel
     * @param Thread $thread
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($channel, Thread $thread) 
    {
        $this->validate(request(), [
            'body'  =>  'required'
        ]);

        $thread->addReply([
            'body'      =>  request('body'),
            'user_id'   =>  auth()->id()
        ]);

        return back();

    }

}
