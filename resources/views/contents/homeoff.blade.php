@extends('layouts.app')

@section('event', $event)
@section('event_id', $event_id)
@section('show_ranking', $show_ranking)

@section('content')

<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">{{__('Dear visitors')}}</h1>
    <p class="lead">{{__('There is currently no competition.')}}</p>
    <hr class="my-4">
    <p>{{__('Competition dates on the website of the STV - FSG.')}}</p>
    <a class="btn btn-primary btn-lg" href="{{ config('global.competitions_url') }}" role="button">{{__('STV competitions')}}</a>
  </div>
</div>

@endsection
