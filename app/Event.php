<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    //
    public function results()
    {
        return $this->hasMany('App\Result');
    }

    /**
     * get Data for Events.
     * @return array  all data
     */
    public function getData()
    {
        $data = DB::table('events as e')
                          ->select('e.id', 'e.name', 'e.created_at',
                            DB::raw("(SELECT NVL(e2.file,'') FROM events e2
                                  WHERE e2.id = e.id and e2.file is not null and e2.updated_at < NOW() - INTERVAL 1 HOUR) AS file"))
                          ->orderBy('e.id','desc')
                          ->get();
        return ($data);
    }
}
