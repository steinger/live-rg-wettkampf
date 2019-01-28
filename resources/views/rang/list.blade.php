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
      @endphp
      @foreach( $gymnasts as $gymnast )
        <tr>
          <th scope="row">{{ $i }}</th>
          <td>{{ $gymnast->startno }}</td>
          <td>{{ $gymnast->name }}</td>
          <td>{{ number_format($gymnast->total,3) }}</td>
        </tr>
        @php
          $i++;
        @endphp
      @endforeach
    </tbody>
  </table>
</div>

@endsection
