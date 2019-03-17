@extends('layouts.app')

@section('event', $event)
@section('event_id', $event_id)
@section('show_ranking', $show_ranking)

@section('content')

<div id="app">
  <live-results lang_start="{{__('Competition is started')}}" lang_text="{{__('There are no results available yet.')}}"></live-results>
</div>

@endsection
