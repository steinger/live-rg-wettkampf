<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadOnlyBase
{
    //
    protected $apparatus_array = [];

    public function all()
    {
        return $this->apparatus_array;
    }

    public function get( $id )
    {
        return $this->apparatus_array[$id];
    }
}
