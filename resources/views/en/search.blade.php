<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
  @include('layouts.navbar')
  <div style="display: inline-block;">
@foreach($data as $item)
@php
$title = $item['episodesList'][0]['episodeId'];
$parts2 = explode('-', $title);
$trimmed_parts2 = array_slice($parts2, 0, count($parts2) - 2);
$animeIdrec = implode('-', $trimmed_parts2);
@endphp
  @if(!in_array($animeIdrec, $blacklist_animeIds))
  <div style="padding-left: 15px; padding-top: 15px; display: inline-block;">
<div class="card" style="width: 15rem;">
<a href="/en/anime-details/{{ $animeIdrec}}">  <img src="{{ $item['animeImg'] }}" class="rounded" alt="" style="height: 318px; width: 239px;">
</a>

  <div class="card-body">
    <h6 class="card-title">{{ $item['animeTitle'] }}</h6>
    <p class="card-text">{{$item['status']}}</p>
    <a href="/en/anime-details/{{ $animeIdrec}}" class="btn btn-primary btn-sm">Details</a>

    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop2_{{$animeIdrec}}">Add to watchlist</button>

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop2_{{$animeIdrec}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Watch list Confirmation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p style="color: black;">yakin nih mau masukin {{ $animeIdrec}}  ke dalem min age</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <form method="POST" action="/adding-watchlist">
              @csrf 
      <input type="hidden" name="animeId" value="{{ $animeIdrec}}">
      <input type="hidden" name="email" value=" {{ Auth::user()->email }}">
      <button type="submit" class="btn btn-danger">Add</button>
      </form>

            </div>
          </div>
        </div>
      </div>


              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$animeIdrec}}">Delete</button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop_{{$animeIdrec}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Blacklist Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p style="color: black;">yakin nih mau hapus {{$animeIdrec}} dari blacklist</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="/del-watchlist">
                @csrf 
  <input type="hidden" name="animeId" value="{{$animeIdrec}}">
  <input type="hidden" name="email" value=" {{ Auth::user()->email }}">
  <button type="submit" class="btn btn-danger">delete from Blacklist</button>
</form>
              </div>
            </div>
          </div>
        </div>


  </div>
  
</div>
</div>
  @endif
@endforeach
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

