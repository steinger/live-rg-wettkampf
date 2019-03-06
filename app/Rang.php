<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rang extends Model
{

    /**
     * getRangKat after category for normal MK
     * @param  int $event_id  Event ID
     * @param  int $cat_id    Category ID
     * @return array          Array of Data
     */
    public function getRangKat($event_id,$cat_id)
    {
        $data = DB::table('results as r')
                          ->select('r.startno', 'r.name',
                          DB::raw("(SELECT SUM(r2.f_score) FROM results r2 WHERE r2.startno = r.startno AND r2.event_id LIKE $event_id AND r2.category LIKE '$cat_id' AND r2.competition_type LIKE 'MK') AS total"))
                          ->distinct()
                          ->where("r.event_id", $event_id)
                          ->where("r.category", $cat_id)
                          ->where("r.competition_type","MK")
                          ->orderBy('total','desc')
                          ->get();
        return ($data);
    }

    /**
     * get count of Live Ranking this Event
     * @param  int $event_id  Event ID
     * @return int            Count 0 or 1
     */
    public function getLiveRanking($event_id)
    {
      $data = DB::table('events')
                        ->where('ranking', 1)
                        ->where('id', $event_id)
                        ->count();
      // dd($data);
      return ($data);
    }
}
