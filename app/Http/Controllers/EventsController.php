<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Event as Event;
use App\Result as Result;

class EventsController extends Controller
{
    //
    public function __construct( Event $event, Result $result )
    {
      $this->event = $event;
      $this->result = $result;
    }

    /**
     * Indes Page for Event
     * @param  Request $request Browser Requests
     * @return array           all data
     */
    public function index()
    {
      $event = $this->event->all()->max();
      $data = [];
      $data = $this->event->getData();
      // dd($data);
      return view('/events/index')->with(array('events' => $data))->with('event_id', $event->id);
    }

    /**
     * Find List of Event and send to event List vue
     * @param  Request $request Browser Requests
     * @return array            Event Name and Event ID
     */
    public function list(Request $request)
    {
      $event = $this->event->find($request->event_id);
      $data = [];
      return view('/contents/list')->with('event', $event->name)->with('event_id', $request->event_id);
    }
}
