<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <title>{{__(config('app.name'))}}</title>
        <!-- Fonts -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
        <link rel="apple-touch-icon-precomposed" href="{{ asset('images/apple-icon.png') }}" />
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="keywords" content="RG,Rhythmische Gymnastik,Schweiz,Suisse" />
        <meta name="description" content="RG Live Resultate der Rhythmische Gymnastik Schweiz" />
    </head>
    <body>
        <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
          <div class="container">
          <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" width="30" height="30" alt="">
            {{__(config('app.name'))}}</a>
            @if ($event_id > 0)
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-item nav-link active" href="{{ route('list', ['event_id' => $event_id]) }}">{{__('List')}}</a>
                  @if ($show_ranking > 0)
                    <a class="nav-item nav-link active" href="{{ route('rang', ['event_id' => $event_id]) }}">{{__('Ranking')}}</a>
                  @endif
                  <a class="nav-item nav-link active" href="{{ route('events') }}">{{__('Events')}}</a>
                </div>
              </div>
              @endif
            <b>@yield('event')</b>
          </div>
        </nav>

@yield('content')
      <div class="pt-5"></div>
      <div class="fixed-bottom">
        <nav class="navbar navbar-dark bg-primary">
          <div class="container">
            <small><strong>{{url('/')}}</strong> <i class="far fa-copyright"></i> <?php echo date('Y');?>
             ({{__('Results without guarantee')}})
           </small>
          </div>
        </nav>
      </div>

      <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
