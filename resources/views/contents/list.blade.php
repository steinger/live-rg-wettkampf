@extends('layouts.app')

@section('event', $event)
@section('event_id', $event_id)
@section('show_ranking', $show_ranking)

@section('content')

<div id="app">
  <list-filter event_id="{{ $event_id }}" lang_search="{{__('Search..')}}" lang_nodata="{{__('No data available.')}}"></list-filter>
</div>

@endsection
