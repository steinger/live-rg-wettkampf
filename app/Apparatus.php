<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apparatus extends ReadOnlyBase
{
    /**
     * protected Array of Apparatus.
     * @var array   Apparatus
     */
    protected $apparatus_array = ['OH' => 'ohg',
                                 'SL' => 'seil',
                                 'RF' => 'reif',
                                 'BL' => 'ball',
                                 'KL' => 'keulen',
                                 'BD' => 'band',
                                 'U1' => 'u1',
                                 'U2' => 'u2'];
}
