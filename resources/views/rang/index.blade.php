@extends('layouts.app')

@section('event', $event)
@section('event_id', $event_id)

@section('content')

<div class="container" style="margin-top: 15px;">

  <div class="list-group">
    @foreach( $categories as $cat )
    <a href="{{ route('rang_list', ['cat_id'=> $cat]) }}" class="list-group-item list-group-item-action">{{$cat}}</a>
    @endforeach
  </div>

</div>

@endsection
