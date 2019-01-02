<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Rang as Rang;
use App\Event as Event;

class RangController extends Controller
{
    public function __construct( Rang $rang, Event $event )
    {
      $this->rang = $rang;
      $this->event = $event;
    }

    /**
     * Index Webseite list Categries
     * @param  Request $request Browser Requests
     * @return array           all data
     */
    public function index(Request $request)
    {
      $event = $this->event->all()->max();
      if (strtotime("now -1 week") < strtotime($event->created_at) )
      {
        $data = [];
        $data = $this->rang->getData($event->id);
        $data = $this->rang->getKat($data);
        // dd($data);
        return view('/rang/index')->with(array('categories' => $data))->with('event', $event->name)->with('event_id', $event->id);
      }
      else {
        return view('/homeoff')->with('event', "")->with('event_id', $event->id);
      }
    }

    /**
     * Ranking list
     * @param  Request $request Browser Requests
     * @return array           all data
     */
    public function list(Request $request)
    {
      $event = $this->event->all()->max();
      $data = [];
      $data = $this->rang->getData($event->id);
      $data = $this->rang->getRangKat($data,$request->cat_id);
      // dd($data);
      return view('/rang/list')->with(array('gymnasts' => $data))->with('event', $event->name)->with('event_id', $request->event_id);
    }
}
