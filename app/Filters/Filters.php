<?php

namespace App\Filters;

use Illuminate\Http\Request;

abstract class Filters
{

    /**
     * @var Builder
     * @var Request
     */
    protected $builder, $request;

    protected $filters = [];

    /**
     * ThreadFilters constructor
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * Apply filters 
     */
    public function apply($builder)
    {

        $this->builder = $builder;

        foreach( $this->getFilters() as $filter => $value) {

            if( method_exists($this, $filter) ) {
                $this->$filter($value);
            } 

        }

        return $this->builder;
    }

    /**
     * Gets only the filters from the request
     *
     * @return array
     */
    public function getFilters()
    {
        return $this->request->only($this->filters);
    }
} 