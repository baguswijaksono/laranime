<!doctype html>
@if (Auth::check() && Auth::user()->theme === 'light')
    <html lang="en">
@else
    <html lang="en" data-bs-theme="dark">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        #myIframe {
            border-radius: 5px;
            overflow: hidden;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')
    @php
        use App\Models\History;
        $email = Auth::user()->email;
        $userHistoryCount = History::where('email', $email)->count();
    @endphp

    @if ($userHistoryCount === 0)

        <center>
            <p style="padding-top: 40vh;">"You haven't watched a single episode of anime yet."</p>
            @if (Auth::check() && Auth::user()->theme === 'light')
                <a class="btn btn-dark" href="/">Browse Some Anime</a>
            @else
                <a class="btn btn-light" href="/">Browse Some Anime</a>
            @endif

        </center>
    @else
        <div class="p-4">
            @if (Auth::check() && Auth::user()->theme === 'light')
                <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Delete All
                </button>
            @else
                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Delete All
                </button>
            @endif

        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">History Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <center>
                            <p>Sure want to delete all of your watch history ? </p>
                        </center>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('history.destroy') }}">
                            @csrf
                            <input type="hidden" name="email" value="{{ $email }}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </td>
        </tr>
        </div>
        <div class="container">
            <div class="row row-cols-lg-4">
                @foreach ($history as $item)
                    @php
                        $url = $item->url;
                        $parts = explode('/', $url);
                        $trimmedUrl = last($parts);
                        $formattedString = str_replace('-', ' ', $trimmedUrl);
                        $formattedString = ucwords($formattedString);
                    @endphp

                    <div class="col p-2">
                        <div class="card" style="max-width: 18rem;height: 16rem;">
                            <iframe style="max-width: 18rem;" id="myIframe"
                                src="https://player.anikatsu.me/?id={{ $trimmedUrl }}"
                                allowfullscreen="false"></iframe>
                            <div class="card-body">
                                <a href="{{ $item->url }}">
                                    <p style="text-decoration: none;">{{ $formattedString }}</p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
