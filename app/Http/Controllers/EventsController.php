<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Event as Event;
use App\Result as Result;
use App\Rang as Rang;

class EventsController extends Controller
{
    //
    public function __construct( Event $event, Result $result, Rang $rang )
    {
      $this->event = $event;
      $this->result = $result;
      $this->rang = $rang;
    }

    /**
     * Indes Page for Event
     * @param  Request $request Browser Requests
     * @return array           all data
     */
    public function index()
    {
      $event = $this->event->all()->max();
      $liveRang = $this->rang->getLiveRanking($event->id);
      $data = [];
      $data = $this->event->getData();
      // dd($data);
      return view('/events/index')->with(array('events' => $data))->with('event_id', $event->id)->with('show_ranking', $liveRang);
    }

    /**
     * Find List of Event and send to event List vue
     * @param  Request $request Browser Requests
     * @return array            Event Name and Event ID
     */
    public function list(Request $request)
    {
      $event = $this->event->find($request->event_id);
      $liveRang = $this->rang->getLiveRanking($event->id);
      $data = [];
      return view('/contents/list')->with('event', $event->name)->with('event_id', $request->event_id)->with('show_ranking', $liveRang);
    }
}
