    <nav class="navbar navbar-inverse">
      <div class="container-collapse">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('home') }}">Today's Tips</a></li>
            <li><a href="{{ route('forum.index') }}">Talk</a></li>
            <li><a href="{{ route('top') }}">Top Tips</a></li>
          </ul>
          @includeWhen(!Auth::user(), 'partial.navigation.user')
        </div><!--/.nav-collapse -->
      </div>
    </nav>
