@extends('layouts.app')

@section('event', $event)
@section('event_id', $event_id)
@section('show_ranking', 1)

@section('content')

<div class="container">

  <div class="alert alert-info">

    <h4 class="alert-heading">{{__('Ranking')}} &middot; {{$title}}</h4>
  </div>
  @if (strtotime("now -4 hour") < strtotime($last_update) )
  <p class="text-center text-info">{{__('Updated')}} {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $last_update)->diffForHumans() }}</p>
  @endif
  <table class="table table-hover">
    <thead class="thead-light">
      <tr>
        <th scope="col">{{__('Rank')}}</th>
        <th scope="col">{{__('Startno')}}</th>
        <th scope="col">{{__('Name')}}</th>
        <th scope="col">{{__('Score')}}</th>
      </tr>
    </thead>
    <tbody>
      @php
        $i = 1;
        $totalTemp = 0;
      @endphp
      @foreach( $gymnasts as $gymnast )
      @php $totalTemp == $gymnast->total ? $rang = $rangTemp : $rang = $i @endphp
        <tr>
          <th scope="row">{{ $rang }}
          @if($rang <= 3)
            <i class="fas fa-medal"></i>
          @endif
          </th>
          <td>{{ $gymnast->startno }}</td>
          <td>{{ $gymnast->name }}</td>
          <td>{{ number_format($gymnast->total,3) }}</td>
        </tr>
        @php
          $totalTemp = $gymnast->total;
          $rangTemp = $rang;
          $i++;
        @endphp
      @endforeach
    </tbody>
  </table>
</div>

@endsection
