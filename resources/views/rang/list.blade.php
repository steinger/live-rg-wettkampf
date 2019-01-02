@extends('layouts.app')

@section('event', $event)
@section('event_id', $event_id)

@section('content')

<div class="container">

  <table class="table">
    <thead>
      <tr>
        <th scope="col">Rang</th>
        <th scope="col">Startnr</th>
        <th scope="col">Name</th>
        <th scope="col">Total</th>
      </tr>
    </thead>
    <tbody>
      @php
        $i = 1;
        $noteTemp = 0;
      @endphp
      @foreach( $gymnasts as $gymnast )
        @php $noteTemp == $gymnast['note'] ? $rang = $rangTemp : $rang = $i @endphp
        <tr>
          <th scope="row">{{ $rang }}</th>
          <td>{{ $gymnast['startnr'] }}</td>
          <td>{{ $gymnast['name'] }}</td>
          <td>{{ number_format($gymnast['note'],3) }}</td>
        </tr>
        @php
          $noteTemp = $gymnast['note'];
          $rangTemp = $rang;
          $i++;
        @endphp
      @endforeach
    </tbody>
  </table>
</div>

@endsection
