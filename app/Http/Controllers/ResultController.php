<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Result as Result;
use App\Event;

class ResultController extends Controller
{
    //
    public function __construct( Result $result )
    {
      $this->result = $result;
    }

    /**
     * Store Result over API insert and update to DB
     * @param  Request $request data over API
     * @return array            answer on Json
     */
    public function storeApi(Request $request)
    {
      Log::info("Result:".$request->rgid.";".$request->startno.";".$request->name.";".$request->f_score);
      $event = Event::all()->max();
      $this->validate($request, [
        'rgid' => 'required|numeric',
        'apparatus_short' => 'required|max:2',
        'startno' => 'required|numeric',
        'name' => 'required|max:255',
        'category' => 'required|max:3',
        'competition_type' => 'required|max:2',
        'apparatus' => 'required|max:20',
        'f_score' => 'required|numeric',
        'd_score' => 'required|max:6',
        'e_score' => 'required|max:6',
        'penalty' => 'sometimes|nullable|max:20'
        ]);
      $rowCount = $this->result->all()->where('rgid',$request->input('rgid'))->where('event_id',$event->id)->count();
      // Log::info($rowCount);
      if ($rowCount > 0)
      {
        $result_update = $this->result->where('rgid',$request->input('rgid'))->where('event_id',$event->id)->first();
        $result_update->apparatus_short = $request->input('apparatus_short');
        $result_update->startno = $request->input('startno');
        $result_update->name = $request->input('name');
        $result_update->category = $request->input('category');
        $result_update->competition_type = $request->input('competition_type');
        $result_update->apparatus = $request->input('apparatus');
        $result_update->f_score = $request->input('f_score');
        $result_update->d_score = $request->input('d_score');
        $result_update->e_score = $request->input('e_score');
        $result_update->penalty = $request->input('penalty',NULL);
        if ($result_update->save())
        {
          return response()->json([
            'success' => true,
            'rgid' => $request->input('rgid')
          ], 201);
        }
        else {
          return response()->json([
            'success' => false,
            'message' => 'Sorry, Result could not be update'
          ], 500);
        }
      }
      else {
        $data = [];
        $data['event_id'] = $event->id;
        $data['rgid'] = $request->input('rgid');
        $data['apparatus_short'] = $request->input('apparatus_short');
        $data['startno'] = $request->input('startno');
        $data['name'] = $request->input('name');
        $data['category'] = $request->input('category');
        $data['competition_type'] = $request->input('competition_type');
        $data['apparatus'] = $request->input('apparatus');
        $data['f_score'] = $request->input('f_score');
        $data['d_score'] = $request->input('d_score');
        $data['e_score'] = $request->input('e_score');
        $data['penalty'] = $request->input('penalty',NULL);
        $data['created_at'] = now();
        $data['updated_at'] = now();
        if ($this->result->insert($data))
        {
          return response()->json([
            'success' => true,
            'rgid' => $data['rgid']
          ], 201);
        }
        else {
          return response()->json([
            'success' => false,
            'message' => 'Sorry, Result could not be save'
          ], 500);
        }
      }
    }
}
