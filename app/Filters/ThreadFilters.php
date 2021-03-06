<?php

namespace App\Filters;

use App\User;

class ThreadFilters extends Filters
{
    /**
     * Thread filters array
     * @var Filters
     */
    protected $filters = ['by', 'popularity'];

    
    /**
     * Filter the query by a given username
     *
     * @param string $username
     * @return mixed
     */
    public function by($username)
    {

        $user = User::where('name', $username)->firstOrFail();
    
        return $this->builder->where('user_id', $user->id);

    }

    /**
     * Filter the query by popularity(number of comments)
     * @return mixed
     */
    public function popularity()
    {
        return $this->builder->orderBy('replies_count', 'desc');
    }

}