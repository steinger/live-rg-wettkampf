@extends('layouts.app')

@section('event', $event)
@section('event_id', $event_id)
@section('show_ranking', 1)

@section('content')


  @if (count($categories))
  <div class="container mt-2">
  <div class="list-group">
    @foreach( $categories as $cat )
    <a href="{{ route('rang_list', ['event_id' => $event_id, 'cat_id'=> $cat->category]) }}" class="list-group-item list-group-item-action">{{$cat->category}}</a>
    @endforeach
  </div>
  @else
  <div class="container">
    <div class="list-group">
      <button type="button" class="list-group-item list-group-item-info">Keine Daten vorhanden.</button>
    </div>
  @endif
</div>

  @if (count($gf_categories))
  <div class="container mt-4">
    <div class="alert alert-secondary">
      <h5>{{__('Apparatus Finals')}}</h5>
    </div>
    <div class="list-group">
      @foreach( $gf_categories as $gf )
      <a href="{{ route('rang_gflist', ['event_id' => $event_id, 'cat_id'=> $gf->category, 'app_id' => $gf->apparatus_short]) }}" class="list-group-item list-group-item-action">{{$gf->gf_category}}</a>
      @endforeach
    </div>
  @endif
</div>

@endsection
