<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Find and share CD101 Lounge Tips! LoungeTips.com lets you share the tips you hear on WWCD, CD101FM in Columbus, OH with fellow listeners who may not have been tuned in to hear them.">
    <meta name="keywords" content="CD101, CD 101, WWCD, 101.1, 102.5, CD101.1, CD102.5, CD1025, CD101 at 102.5, Columbus, Ohio, Radio, The Alternative Station, Alternative Station, Columbus' Best Radio, Lounge Tips, Lounge, Tips, Lounge Points, Points">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" integrity="sha384-dNpIIXE8U05kAbPhy3G1cz+yZmTzA6CY8Vg/u2L9xRnHjJiAK76m2BIEaSEV+/aU" crossorigin="anonymous">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
          <a href="{{ route('home') }}"><img src="/images/logo.png" alt="CD102.5 Lounge Tips" class="img-responsive" /></a>
        </div>
      </div>
      <div class="row row-no-padding">
        <div class="col-xs-12 col-md-10 col-md-offset-1">
          @include('partial.navigation.index')
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-10 col-md-offset-1 well">
          @if(Session::has('status'))
          <div class="alert alert-{{ Session::get('status.type') }}" role="alert">
            {{ Session::get('status.body') }}
          </div>
          @endif
          @yield('content')
        </div>
      </div>
    </div>
    <footer class="footer">
      <div class="container">
        <p class="text-muted text-center">
          Copyright &copy; {{ date("Y") }} &mdash;
          LoungeTips: {{ number_format(Cache::get('totalTips', '12000'), 0, '.', ',') }} tips shared and counting! &mdash;
          LoungeTips.com is NOT affiliated with CD102.5
        </p>
      </div>
    </footer>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-72848314-1', 'auto');
        ga('send', 'pageview');

    </script>
    <script src="/js/app.js"></script>
    @yield('custom_script')
  </body>
</html>

