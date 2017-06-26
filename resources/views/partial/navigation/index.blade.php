    <nav class="navbar navbar-inverse">
      <div class="container-collapse">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('home') }}">Today's Tips</a></li>
            <li><a href="{{ route('forum.index') }}">Talk</a></li>
            <li><a href="{{ route('top') }}">Top Tips</a></li>
          </ul>
          @if (!Auth::user())
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
          </ul>
          @else
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ route('user.profile', Auth::user()) }}">{{ Auth::user()->name }}</a></li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
          </ul>
          @endif
        </div>
        @if (Cache::has('recentThreads'))
        <div class="talking">
          What people are talking about:
          @foreach (Cache::get('recentThreads') as $thread)
            <span class="thread">
            @if (!$loop->first)
              &nbsp;&middot;&nbsp;
            @endif
            @if ( property_exists($thread, 'posts') )
              <a href="{{ Forum::route('thread.show', $thread) }}?page={{ ceil($thread->posts->count() / 15) }}#post-{{ $thread->posts->count() }}">{{ $thread->title }}</a>
            @endif
            </span>
          @endforeach
        </div>
        @endif
      </div>
    </nav>
