<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Result as Result;
use App\Event as Event;


class ContentsController extends Controller
{
    //
    public function __construct( Result $result, Event $event )
    {
      $this->result = $result;
      $this->event = $event;
    }

    /**
     * home_api Start for vue Page with get Data over API
     * @return  array  data for startpage
     */
    public function home_api()
    {
      $event = $this->event->all()->max();
      // dd($event);
      if ($event == null) { return view('/homeoff')->with('event', "")->with('event_id', 0); }
      if (strtotime("now -3 day") < strtotime($event->created_at) )
      {
        return view('/home')->with('event', $event->name)->with('event_id', $event->id);
      }
      else {
        return view('/homeoff')->with('event', "")->with('event_id', $event->id);
      }
    }

    /**
     * live_api Returns a JSON payload
     * @param  int $page  Page
     * @return array      All data on Json
     */
    public function live_api($page)
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
      $event = $this->event->find($request->event_id);
      $data = [];
      $data  = $this->result->getList($request->event_id);
      // dd($data);
      return view('/list')->with(array('results' => $data))->with('event', $event->name)->with('event_id', $request->event_id);
    }

    /**
     * list_api data for List
     * @param  int $event_id  Event ID
     * @return array          All data on Json
     */
    public function list_api($event_id)
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
      $event = $this->event->find($request->event_id);
      $data = [];
      $data  = $this->result->getGymnasts($request->event_id,$request->startno);
      $dataName = $this->result->getGymnastsName($request->event_id,$request->startno);
      // dd($data);
      return view('/gymnasts')->with(array('results' => $data))->with(array('names' => $dataName))->with('event', $event->name)->with('event_id', $request->event_id);
    }
}
