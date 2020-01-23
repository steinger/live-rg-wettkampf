<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Event as Event;
use App\Result as Result;
use App\Rang as Rang;

class EventController extends Controller
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
      $this->event->findOrFail(1);
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
      $event = $this->event->findOrFail($request->event_id);
      $liveRang = $this->rang->getLiveRanking($event->id);
      $data = [];
      return view('/contents/list')->with('event', $event->name)->with('event_id', $request->event_id)->with('show_ranking', $liveRang);
    }

    /**
     * Store Event over API into DB
     * @param  Request $request API Request
     * @return array            answer on Json
     */
    public function storeApi(Request $request)
    {
      Log::info("Event:".$request->name .";".$request->ranking);
      $this->validate($request, [
        'name' => 'required|max:255',
        'ranking' => 'sometimes|nullable|numeric|max:1'
        ]);
      $data = [];
      $data['name'] = $request->input('name');
      $data['ranking'] = $request->input('ranking', 1);
      $data['created_at'] = now();
      $data['updated_at'] = now();
      if ($this->event->insert($data))
      {
        return response()->json([
          'success' => true,
          'name' => $data['name']
        ], 201);
      }
      else {
        return response()->json([
          'success' => false,
          'message' => 'Sorry, Event could not be added'
        ], 500);
      }
    }
}
