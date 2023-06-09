@if (!in_array($data->animeId, $blacklist_animeIds))
    @if (!in_array($data->animeId, $minagelist))
        <!doctype html>
        @if (Auth::check() && Auth::user()->theme === 'light')
            <html lang="en">
        @else
            <html lang="en" data-bs-theme="dark">
        @endif

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Bootstrap demo</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
                crossorigin="anonymous">
            <style>
                .kartu {
                    position: relative;
                    display: inline-block;
                }

                .badge {
                    position: absolute;
                    top: 7px;
                    left: 7px;
                    background-color: #007bff;
                    color: #fff;
                    font-weight: bold;
                    z-index: 1;
                }
            </style>
        </head>

        <body>
            @include('layouts.navbar')
            <div class="row g-0 ">

                <div class="col-4 ">
                    <div style="padding-top: 35px;"></div>
                    <div style="padding-left: 35px;">

                        <div class="kartu">
                            <div class="badge bg-primary text-wrap ">
                                {{ $data->status }}
                            </div>
                            <a href="/en/anime-details/{{ $data['animeId'] }}">
                                <img src="{{ $data['animeImg'] }}" class="rounded"style="width: 450px; height: 615px;"
                                    alt="...">
                            </a>

                        </div>
                    </div>
                </div>

                <div style="max-width:950px">
                    <h1 style="padding-top: 2vw;">{{ $data->animeTitle }}</h1>
                    @php
                        
                        $m = $data->type = str_replace(' ', '-', $data->type);
                    @endphp
                    <a href="/en/season/{{ $m }}">
                        <h6>{{ $data->type }}</h6>
                    </a>
                    <h6> Other Name : {{ $data->otherNames }} </h6>
                    <h6>
                        Genre:
                        @php
                            $dbgenrelist = \App\Models\genreList::all();
                            $genres = str_replace('"', '', $data->genres);
                            $genres = str_replace('[', '', $genres);
                            $genres = str_replace(']', '', $genres);
                            $genres = explode(',', $genres);
                        @endphp

                        @foreach ($genres as $genre)
                            @php
                                $trimmedGenre = trim($genre);
                            @endphp
                            @foreach ($dbgenrelist as $dbGenre)
                                @if ($dbGenre->name == $trimmedGenre)
                                    <a
                                        href="{{ route('userGenre', ['genre' => $dbGenre->slug, 'page' => 1]) }}">{{ $trimmedGenre }}</a>
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endif
                            @endforeach
                        @endforeach
                    </h6>
                    <p>Synopsis : {{ $data->synopsis }}</p>
                    <div class="container">
                        <div class="row">
                            @foreach ($episode as $eps)
                                <div class="col p-1">
                                    @if (Auth::check() && Auth::user()->theme === 'light')
                                        <a href="/en/watch/{{ $eps['episodeId'] }}" class="btn btn-primary"
                                            style="width: 135px;">Episode {{ $eps['episodeNum'] }}</a>
                                        <div style="padding-bottom: 5px;"></div>
                                    @else
                                        <a href="/en/watch/{{ $eps['episodeId'] }}" class="btn btn-success"
                                            style="width: 135px;">Episode {{ $eps['episodeNum'] }}</a>
                                        <div style="padding-bottom: 5px;"></div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
            </script>
        </body>

        </html>
    @else
        @php
            $minAge = \App\Models\MinAge::where('animeId', $data->animeId)->value('minAge');
        @endphp
        @if ($age > $minAge)
            <!doctype html>
            @if (Auth::check() && Auth::user()->theme === 'light')
                <html lang="en">
            @else
                <html lang="en" data-bs-theme="dark">
            @endif

            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Bootstrap demo</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
                    crossorigin="anonymous">
                <style>
                    .kartu {
                        position: relative;
                        display: inline-block;
                    }

                    .badge {
                        position: absolute;
                        top: 7px;
                        left: 7px;
                        background-color: #007bff;
                        color: #fff;
                        font-weight: bold;
                        z-index: 1;
                    }
                </style>
            </head>

            <body>

                @include('layouts.navbar')
                <div class="row g-0 ">

                    <div class="col-4 ">
                        <div style="padding-top: 35px;"></div>
                        <div style="padding-left: 35px;">

                            <div class="kartu">
                                <div class="badge bg-primary text-wrap ">
                                    {{ $data->status }}
                                </div>
                                <a href="/en/anime-details/{{ $data['animeId'] }}">
                                    <img src="{{ $data['animeImg'] }}"
                                        class="rounded"style="width: 450px; height: 615px;" alt="...">
                                </a>

                            </div>
                        </div>
                    </div>

                    <div style="max-width:950px">
                        <h1 style="padding-top: 2vw;">{{ $data->animeTitle }}</h1>
                        @php
                            
                            $m = $data->type = str_replace(' ', '-', $data->type);
                        @endphp
                        <a href="/en/season/{{ $m }}">
                            <h6>{{ $data->type }}</h6>
                        </a>
                        <h6> Other Name : {{ $data->otherNames }} </h6>
                        <h6>
                            Genre:
                            @php
                                $dbgenrelist = \App\Models\genreList::all();
                                $genres = str_replace('"', '', $data->genres);
                                $genres = str_replace('[', '', $genres);
                                $genres = str_replace(']', '', $genres);
                                $genres = explode(',', $genres);
                            @endphp

                            @foreach ($genres as $genre)
                                @php
                                    $trimmedGenre = trim($genre);
                                @endphp
                                @foreach ($dbgenrelist as $dbGenre)
                                    @if ($dbGenre->name == $trimmedGenre)
                                        <a
                                            href="{{ route('userGenre', ['genre' => $dbGenre->slug, 'page' => 1]) }}">{{ $trimmedGenre }}</a>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach


                        </h6>
                        <p>Synopsis : {{ $data->synopsis }}</p>
                        <div class="container">
                            <div class="row">
                                @foreach ($episode as $eps)
                                    <div class="col p-1">
                                        @if (Auth::check() && Auth::user()->theme === 'light')
                                            <a href="/en/watch/{{ $eps['episodeId'] }}" class="btn btn-primary"
                                                style="width: 135px;">Episode {{ $eps['episodeNum'] }}</a>
                                            <div style="padding-bottom: 5px;"></div>
                                        @else
                                            <a href="/en/watch/{{ $eps['episodeId'] }}" class="btn btn-success"
                                                style="width: 135px;">Episode {{ $eps['episodeNum'] }}</a>
                                            <div style="padding-bottom: 5px;"></div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
                </script>
            </body>

            </html>
        @else
            <!doctype html>
            @if (Auth::check() && Auth::user()->theme === 'light')
                <html lang="en">
            @else
                <html lang="en" data-bs-theme="dark">
            @endif

            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Bootstrap demo</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
                    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
                    crossorigin="anonymous">
                <style>
                    .kartu {
                        position: relative;
                        display: inline-block;
                    }

                    .badge {
                        position: absolute;
                        top: 7px;
                        left: 7px;
                        background-color: #007bff;
                        color: #fff;
                        font-weight: bold;
                        z-index: 1;
                    }
                </style>
            </head>

            <body>
                <center>
                    <p style="padding-top: 40vh;">"It seems we can't find the anime you're looking for."</p>
                    @if (Auth::check() && Auth::user()->theme === 'light')
                        <a class="btn btn-dark" href="/">Browse Some Anime</a>
                    @else
                        <a class="btn btn-light" href="/">Browse Some Anime</a>
                    @endif

                </center>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
                </script>
            </body>

            </html>
        @endif

    @endif
@else
    <!doctype html>
    @if (Auth::check() && Auth::user()->theme === 'light')
        <html lang="en">
    @else
        <html lang="en" data-bs-theme="dark">
    @endif

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <style>
            .kartu {
                position: relative;
                display: inline-block;
            }

            .badge {
                position: absolute;
                top: 7px;
                left: 7px;
                background-color: #007bff;
                color: #fff;
                font-weight: bold;
                z-index: 1;
            }
        </style>
    </head>

    <body>
        <center>
            <p style="padding-top: 40vh;">"It seems we can't find the anime you're looking for."</p>
            @if (Auth::check() && Auth::user()->theme === 'light')
                <a class="btn btn-dark" href="/">Browse Some Anime</a>
            @else
                <a class="btn btn-light" href="/">Browse Some Anime</a>
            @endif

        </center>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
        </script>
    </body>

    </html>

@endif
