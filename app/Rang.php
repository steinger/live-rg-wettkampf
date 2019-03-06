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

    /**
     * get Liste for GF
     * @param  int $event_id  Event ID
     * @return array          Array of Data
     */
    public function getListeGF($event_id)
    {
      $apparatuses = new Apparatus();
      $data = DB::table('results')
                        ->select('category', 'apparatus_short')
                        ->distinct()
                        ->where("event_id", $event_id)
                        ->where("competition_type","GF")
                        ->orderBy('category')
                        ->get();
      foreach ($data as $key => $value) {
        $value->gf_category = $value->category.' - '.ucfirst($apparatuses->get($value->apparatus_short));
      }
      // dd($data);
      return ($data);
    }

    /**
     * [getRangGFKat description]
     * @param  int $event_id  Event ID
     * @param  int $cat_id    Category ID
     * @param  int $app_id    shor Apparatus
     * @return array          Array of Data
     */
    public function getRangGFKat($event_id, $cat_id, $app_id)
    {
      $data = DB::table('results as r')
                        ->select('r.startno', 'r.name',
                        DB::raw("(SELECT SUM(r2.f_score) FROM results r2 WHERE r2.startno = r.startno AND r2.event_id LIKE $event_id AND r2.category LIKE '$cat_id' AND r2.apparatus_short LIKE '$app_id' AND r2.competition_type LIKE 'GF') AS total"))
                        ->distinct()
                        ->where("r.event_id", $event_id)
                        ->where("r.apparatus_short", $app_id)
                        ->where("r.category", $cat_id)
                        ->where("r.competition_type","GF")
                        ->orderBy('total','desc')
                        ->get();
                        // dd($data);
      return ($data);
    }

    /**
     * get Apparatus Name
     * @param  [type] $app_id  shor Apparatus  ID
     * @return string         Long Apparatus Name
     */
    public function getAppName($app_id)
    {
      $apparatuses = new Apparatus();
      return ucfirst($apparatuses->get($app_id));
    }
}
