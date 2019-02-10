@extends('layouts.app')

@section('event', $event)
@section('event_id', $event_id)
@section('show_ranking', $show_ranking)

@section('content')

<div id="app">
  <live-results></live-results>
</div>

@endsection
