<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Laranime</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Server
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('home')}}">English</a></li>
          </ul>
</li>

<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Manage
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('blacklist')}}">Blacklist</a></li>
            <li><a class="dropdown-item" href="{{route('minage')}}">Minimum Age</a></li>
            <li><a class="dropdown-item" href="{{ route('genre') }}">Genre</a></li>
            @if(Auth::user()->role == 'superadmin')
            <li><a class="dropdown-item" href="{{ route('user') }}">User</a></li>
            @endif


          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Populate Database
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('prepopulatePopular')}}">Populate Popular</a></li>
            <li><a class="dropdown-item" href="{{route('prepopulateAnime')}}">Populate Anime</a></li>
            <li><a class="dropdown-item" href="{{route('prepopulateMovie')}}">Populate Movie</a></li>
            <li><a class="dropdown-item" href="{{ route('prepopulateTopAir') }}">Populate Top Airing</a></li>
            <li><a class="dropdown-item" href="{{ route('prepopulateRecent') }}">Populate Recent</a></li>
            <li><a class="dropdown-item" href="{{ route('prepopulateGenre') }}">Populate Genre</a></li>
                     
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Insert Database
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('popularPreInsert')}}">Insert Popular</a></li>
            <li><a class="dropdown-item" href="{{route('prepopulateAnime')}}">Insert Anime</a></li>
            <li><a class="dropdown-item" href="{{route('moviePreInsert')}}">Insert Movie</a></li>
            <li><a class="dropdown-item" href="{{ route('topairPreInsert') }}">Insert Top Airing</a></li>
            <li><a class="dropdown-item" href="{{ route('prepopulateRecent') }}">Insert Recent</a></li>
            <li><a class="dropdown-item" href="{{ route('prepopulateGenre') }}">Insert Genre</a></li>
                     
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Database
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('admin-popular-manage')}}">Popular</a></li>
            <li><a class="dropdown-item" href="{{route('admin-anime-manage')}}">Anime</a></li>
            <li><a class="dropdown-item" href="{{route('admin-movie-manage')}}">Movie</a></li>
            <li><a class="dropdown-item" href="{{ route('admin-topAir-manage') }}">Top Airing</a></li>
            <li><a class="dropdown-item" href="{{ route('admin-recent-manage') }}">Recent</a></li>
            <li><a class="dropdown-item" href="{{ route('admin-genre-manage') }}">Genre</a></li>
                     
          </ul>
        </li>

      </ul>
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
                                <a class="dropdown-item" href="/en">
                                      Switch to Normal User
                                    </a>

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
    </div>
  </div>
</nav>