<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Rang as Rang;
use App\Event as Event;
use App\Result as Result;

class RangController extends Controller
{
    public function __construct( Rang $rang, Event $event, Result $result )
    {
      $this->rang = $rang;
      $this->event = $event;
      $this->result = $result;
    }

    /**
     * Index Webpage list Categries
     * @param  Request $request Browser Requests
     * @return array           all data
     */
    public function index(Request $request)
    {
      $event = $this->event->find($request->event_id);
      $liveRang = $this->rang->getLiveRanking($event->id);
      if ($liveRang)
      {
        $data = [];
        $data['categories'] = $this->result->select('category')->distinct()->where('event_id', $event->id)->where('competition_type','MK')->get()->sortby('category');
        // dd($data);
        $data['gf_categories'] = $this->rang->getListeGF($event->id);
        return view('/rang/index')->with($data)->with('event', $event->name)->with('event_id', $event->id)->with('show_ranking', $liveRang);
      }
      else {
        return view('/contents/homeoff')->with('event', "")->with('event_id', $event->id)->with('show_ranking', $liveRang);
      }
    }

    /**
     * Ranking list for MK
     * @param  Request $request Browser Requests
     * @return array           all data
     */
    public function list(Request $request)
    {
      $event = $this->event->find($request->event_id);
      $liveRang = $this->rang->getLiveRanking($event->id);
      $last_update = $this->result->where('category', $request->cat_id)->where('competition_type',"MK")->max('updated_at');
      $data = [];
      $data = $this->rang->getRangKat($event->id, $request->cat_id);
      // dd($data);
      return view('/rang/list')->with(array('gymnasts' => $data))->with('event', $event->name)->with('event_id', $event->id)->with('title',$request->cat_id)->with('show_ranking', $liveRang)->with('last_update', $last_update);
    }

    /**
     *  GF List
     * @param  Request $request Browser Requests
     * @return array            all data
     */
    public function gflist(Request $request)
    {
      $event = $this->event->find($request->event_id);
      $liveRang = $this->rang->getLiveRanking($event->id);
      $last_update = $this->result->where('category', $request->cat_id)->where('apparatus_short',$request->app_id)->where('competition_type',"GF")->max('updated_at');
      $data = [];
      $data = $this->rang->getRangGFKat($event->id, $request->cat_id, $request->app_id);
      // dd($data);
      $total = $request->cat_id.' - '.$this->rang->getAppName($request->app_id);
      return view('/rang/list')->with(array('gymnasts' => $data))->with('event', $event->name)->with('event_id', $event->id)->with('title',$total)->with('show_ranking', $liveRang)->with('last_update', $last_update);
    }
}
