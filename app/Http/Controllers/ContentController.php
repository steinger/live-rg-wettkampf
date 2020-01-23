<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Result as Result;
use App\Event as Event;
use App\Rang as Rang;


class ContentController extends Controller
{
    //
    public function __construct( Result $result, Event $event, Rang $rang )
    {
      $this->result = $result;
      $this->event = $event;
      $this->rang = $rang;
    }

    /**
     * home_api Start for vue Page with get Data over API
     * @return  array  data for startpage
     */
    public function homeApi()
    {
      $event = $this->event->all()->max();
      // dd($event);
      if ($event === null) { return view('/contents/homeoff')->with('event', "")->with('event_id', 0)->with('show_ranking', 0); }
      $liveRang = $this->rang->getLiveRanking($event->id);
      if (strtotime("now -3 day") < strtotime($event->created_at) )
      {
        return view('/contents/home')->with('event', $event->name)->with('event_id', $event->id)->with('show_ranking', $liveRang);
      }
      else {
        return view('/contents/homeoff')->with('event', "")->with('event_id', $event->id)->with('show_ranking', $liveRang);
      }
    }

    /**
     * live_api Returns a JSON payload
     * @param  int $page  Page
     * @return array      All data on Json
     */
    public function liveApi($page)
    {
     $event = $this->event->all()->max();
     $data = [];
     $data  = $this->result->getResults_api($event->id,$page);
     return response()->json($data);
    }

    /**
     * List for Vue page
     * @param  Request $request Browser Requests
     * @return array           for list page
     */
    public function list(Request $request)
    {
      $event = $this->event->findOrFail($request->event_id);
      $liveRang = $this->rang->getLiveRanking($event->id);
      // dd($data);
      return view('/contents/list')->with('event', $event->name)->with('event_id', $request->event_id)->with('show_ranking', $liveRang);
    }

    /**
     * list_api data for List
     * @param  int $event_id  Event ID
     * @return array          All data on Json
     */
    public function listApi($event_id)
    {
      $event = $this->event->find($event_id);
      $data = [];
      $data  = $this->result->getList($event_id);
      // dd($data);
      return response()->json($data);
    }

    /**
     * Data for one gymnasts
     * @param  Request $request Browser Requests
     * @return array            All Data
     */
    public function gymnasts(Request $request)
    {
      $event = $this->event->findOrFail($request->event_id);
      $liveRang = $this->rang->getLiveRanking($event->id);
      $data = [];
      $data  = $this->result->getGymnasts($request->event_id,$request->startno);
      $dataName = $this->result->getGymnastsName($request->event_id,$request->startno);
      // dd($data);
      return view('/contents/gymnasts')->with(array('results' => $data))->with(array('names' => $dataName))->with('event', $event->name)->with('event_id', $request->event_id)->with('show_ranking', $liveRang);
    }
}
