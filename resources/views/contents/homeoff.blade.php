@extends('layouts.app')

@section('event', $event)
@section('event_id', $event_id)

@section('content')

<div class="container">
  <div class="jumbotron">
    <h1 class="display-4">Liebe Besucher</h1>
    <p class="lead">Zur Zeit findet kein Wettkampf statt.</p>
    <hr class="my-4">
    <p>Wettkampf-Termine auf der Webseite des STV - FSG.</p>
    <a class="btn btn-primary btn-lg" href="http://www.stv-fsg.ch/de/sportarten/rhythmische-gymnastik/wettkaempfe/" role="button">STV Wettkämpfe</a>
  </div>
</div>

@endsection
