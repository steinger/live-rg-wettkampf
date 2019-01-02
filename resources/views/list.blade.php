@extends('layouts.app')

@section('event', $event)
@section('event_id', $event_id)

@section('content')

<div id="app">
  <list-filter event_id="{{ $event_id }}"></list-filter>
</div>

@endsection
