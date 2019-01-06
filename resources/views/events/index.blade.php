@extends('layouts.app')

@section('event', __('Events'))
@section('event_id', $event_id)

@section('content')

<div class="container">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">{{__('Event')}}</th>
        <th scope="col">{{__('PDF')}}</th>
        <th scope="col">{{__('Date')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach( $events as $event )
      <tr>
        <td><a href="{{ route('event_list', ['event_id' => $event->id]) }}"> {{ $event->name }}</a>
        <td>
          @if ($event->file)
          <a href="{{asset('storage/'.$event->file)}}">
            <span data-toggle="tooltip" title="{{__('Ranking on PDF')}}">
            <i class="fas fa-file-pdf"></i></span>
          </a>
          @endif
        </td>
        </td>
        <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $event->created_at)->formatLocalized('%d.%m.%Y')}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
