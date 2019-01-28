<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rang extends Model
{

    public function getRangKat($cat_id, $event_id)
    {
        $data = DB::table('results as r')
                          ->select('r.startno', 'r.name',
                          DB::raw("(SELECT SUM(r2.f_score) FROM results r2 WHERE r2.startno = r.startno AND r2.event_id LIKE $event_id AND r2.category LIKE '$cat_id') AS total"))
                          ->distinct()
                          ->whereRaw("r.category LIKE '$cat_id'")
                          ->whereRaw("r.event_id LIKE $event_id")
                          ->orderBy('total','desc')
                          ->get();
        return ($data);
    }
}
