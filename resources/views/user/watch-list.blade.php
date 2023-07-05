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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    @include('layouts.navbar')
    @php
    use App\Models\Watchlists;
    use App\Models\EnDetails;
    $email = Auth::user()->email;
    $userWatchlistsCount = Watchlists::where('email', $email)->count();
@endphp
    @if($userWatchlistsCount === 0)
<center>
<p style="padding-top: 40vh;">"You haven't added a single anime yet."</p>
      @if (Auth::check() && Auth::user()->theme === 'light')
      <a class="btn btn-dark" href="/">Browse Some Anime</a>
@else
<a class="btn btn-light" href="/">Browse Some Anime</a>
@endif

      </center>
    @else
    <div class="container text-center">
  <div class="row row-cols-4 row-cols-lg-5 g-2 g-lg-3">
    @foreach ($watchlist as $item)
    <div class="col">
    @php
    $anim = EnDetails::where('animeId', $item)->first();
    @endphp
    

<div style="padding-left: 15px; padding-top: 15px; display: inline-block;">
<div class="card" style=" width: 175px;">
<a href="/en/anime-details/{{$item}}">  <img src="{{ $anim->animeImg }}" class="rounded" alt="" style="height : 250px; width: 175px;">

</a>
  <div class="card-body">
  <h6 style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; overflow: hidden; text-overflow: ellipsis;">{{ $anim->animeTitle }}</h6>
    <p class="card-text">{{$anim->status}}</p>
    @if (Auth::check() && Auth::user()->theme === 'light')
    <a href="/en/anime-details/{{ $item}}" class="btn btn-dark btn-sm">Details</a>
@else
<a href="/en/anime-details/{{ $item}}" class="btn btn-light btn-sm">Details</a>
@endif

      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$item}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg>
              </button>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop_{{$item}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Watchlist Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Sure want to delete {{$item}} from Watchlist ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="/del-watchlist">
                @csrf 
  <input type="hidden" name="animeId" value="{{$item}}">
  <input type="hidden" name="email" value=" {{ Auth::user()->email }}">
  <button type="submit" class="btn btn-danger">Delete</button>
</form>
              </div>
            </div>
          </div>
        </div>
<!--endmodal-->

      

  </div>
  
</div>
</div>
</div>

@endforeach



</div>
</div>

    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
