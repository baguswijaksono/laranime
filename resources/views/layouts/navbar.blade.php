<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">Laranime</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Anime
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/en/popular/1">Popular Anime</a></li>
            <li><a class="dropdown-item" href="/en/recent-release/1">Recent Release</a></li>
            <li><a class="dropdown-item" href="/en/anime-movies/1">Anime Movies</a></li>
            <li><a class="dropdown-item" href="/en/top-airing/1">Top Airing</a></li>
            <li><a class="dropdown-item" href="{{route('all')}}">All Anime</a></li>
            <li><a class="dropdown-item" href="{{route('season')}}">Group by Season</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Genre
          </a>
          <ul class="dropdown-menu">
          <div>
  <ul style="list-style: none; margin: 0; padding: 0; width: 400px;">
  @php 
  use App\Models\genreList;
  $genre = genreList::all();
  @endphp
  @foreach($genre as $genrelist)
  <li style="display: inline-block; width: 180px;">
      <a class="dropdown-item" href="/en/genre/{{$genrelist->slug}}/1">{{$genrelist->name}}</a>
    </li>
  @endforeach



  </ul>
</div>

          </ul>
        </li>

      </ul>

<form role="search" id="search-form">
  <input class="form-control" type="text" placeholder="Search" aria-label="Search" id="inputan" style="width: 55vw; text-align: center;">
</form>


      
      <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="/setting">
                                      Settings
                                    </a>
                                    @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin'))
                                    <a class="dropdown-item" href="{{ route('admin') }}">Switch to admin</a>
@endif

@php
    $url = $_SERVER['REQUEST_URI'];
@endphp

<a class="dropdown-item" href="{{ route('history') }}">
        My Watch History
    </a>

    <a class="dropdown-item" href="{{ route('watchlist') }}">
        My Watch List
    </a>

    @if (Auth::check() && Auth::user()->theme === 'light')
    <a class="dropdown-item" href="{{ route('dark') }}">
        Dark Mode
    </a>
@else
<a class="dropdown-item" href="{{ route('light') }}">
        Light Mode
    </a>
@endif




                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

<script>
    document.querySelector('#search-form').addEventListener('submit', function(e) {
        e.preventDefault();
        var inputan = document.querySelector('#inputan').value;
        var url = window.location.origin + '/en/search/' + inputan;
        window.location.href = url;
    });
</script>
    </div>
  </div>
</nav>