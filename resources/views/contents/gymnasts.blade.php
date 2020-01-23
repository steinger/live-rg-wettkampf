@extends('layouts.app')

@section('event', $event)
@section('event_id', $event_id)
@section('show_ranking', $show_ranking)

@section('content')

  @if (count($names))
  <div class="container mt-2">
    <div class="alert alert-info">
      @foreach( $names as $name )
      <h4 class="alert-heading">{{$name->startno}} - {{$name->name}} &middot; {{$name->category}}</h4>
      @endforeach
    </div>
    <ul class="list-group">
      @foreach( $results as $result )
      <li class="list-group-item">
        <div class="media">
            @if($result->apparatus_short)
              <img class="mr-3" src="{{ asset('images/'.$result->apparatus_short.'.png') }}" alt="rg image">
            @else
              <img class="mr-3" src="{{ asset('images/apple-icon.png') }}" alt="rg image" width="80">
            @endif
          <div class="media-body">
            <h4>{{ $result->apparatus }}: {{ $result->f_score }}</h4>
            <strong>D:{{ $result->d_score }} E:{{ $result->e_score }} {{ $result->penalty}}</strong>
            <br />
            <i class="far fa-clock"></i> {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $result->updated_at)->isoFormat('lll')}} &middot; <small>{{ $result->updated_at_humans }}</small>
          </div>
        </div>
      </li>
      @endforeach
    </ul>
  </div>
@else
<div class="container">
  <div class="list-group">
    <button type="button" class="list-group-item list-group-item-info">{{__('No data available.')}}</button>
  </div>
</div>
@endif

@endsection
