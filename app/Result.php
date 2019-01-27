<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Result extends Model
{
    //
    protected $dates = [
    'created_at',
    'updated_at'
    ];

    //
    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id', 'id');
    }

    /**
     * getResults over API for Results
     * @param  int $event_id Event ID
     * @param  int $page     Number of Page / results
     * @return array         all data
     */
    public function getResults_api($event_id,$page)
    {
        $data = DB::table('results as r')
                          ->select('r.id', 'r.apparatus', 'r.startno', 'r.name', 'r.body', 'r.updated_at','r.event_id' )
                          ->whereRaw("r.event_id LIKE $event_id")
                          ->offset(0)
                          ->limit($page)
                          ->orderBy('r.updated_at','desc')
                          ->get();
        return ($this->parse($data));
    }

    /**
     * getList List of Results
     * @param  int $event_id  Event ID
     * @return array          all data
     */
    public function getList($event_id)
    {
      $data = DB::table('results as r')
                        ->select('r.startno', 'r.name', 'r.event_id',
                        DB::raw("(SELECT count(*) FROM results r2
                                WHERE r2.startno = r.startno and r2.event_id LIKE $event_id) AS count"))
                        ->distinct()
                        ->whereRaw("r.event_id LIKE $event_id")
                        ->orderBy('r.startno')
                        ->get();
      return $data;
    }

    /**
     * getGymnasts get Results of Gymnasts
     * @param  int $event_id Event ID
     * @param  int $startno  Nummber of start
     * @return array          data
     */
    public function getGymnasts($event_id, $startno)
    {
      $data = DB::table('results as r')
                        ->select('r.apparatus', 'r.body', 'r.updated_at')
                        ->whereRaw("r.event_id LIKE $event_id")
                        ->whereRaw("r.startno = $startno")
                        ->orderBy('r.updated_at','desc')
                        ->get();
      return ($this->parse($data));
    }

    /**
     * getGymnastsName get Name of Gymnasts
     * @param  int $event_id  Event ID
     * @param  int $startno   Number of start
     * @return array          data
     */
    public function getGymnastsName($event_id, $startno)
    {
      $data = DB::table('results as r')
                        ->select('r.startno', 'r.name')
                        ->distinct()
                        ->whereRaw("r.event_id LIKE $event_id")
                        ->whereRaw("r.startno = $startno")
                        ->get();
      return $data;
    }

    /**
     * webPreparation added an change fields for web
     * @param  array $data all data
     * @return array       all data
     */
    public function webPreparation($data)
    {
      $apparatuses = new Apparatus();
      foreach ($data as $key => $value) {
        if (array_key_exists($value->apparatus_short, $apparatuses->all()))
        {
            $value->apparatus_short = $apparatuses->get($value->apparatus_short);
            $value->imageUrl = "images/".$value->apparatus_short.".png";
        }
        else {
          $value->apparatus_short = 0;
          $value->imageUrl = "images/apple-icon.png";
        }
        $value->f_score = number_format($value->f_score, 3, '.', '');
        $value->updated_at_humans = Carbon::createFromFormat('Y-m-d H:i:s', $value->updated_at)->diffForHumans();
      }
      // dd($data);
      return $data;
    }
}
