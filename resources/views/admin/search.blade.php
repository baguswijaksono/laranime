<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
  @include('layouts.navbar')
  <div style="display: inline-block;">

@foreach($data as $item)
  <div style="padding-left: 15px; padding-top: 15px; display: inline-block;">
  <div class="card" style="width: 15rem;">
  <a href="/en/anime-details/{{ $item['animeId']}}">  <img src="{{ $item['animeImg']}}" class="rounded" alt="..." style="height: 318px; width: 239px;"></a>
  <div class="card-body">
    <h6 class="card-title">{{ $item['animeTitle']}}</h6>
    <p class="card-text">{{ $item['status']}}</p>
    <a href="/en/anime-details/{{ $item['animeId']}}" class="btn btn-primary btn-sm">See Details</a>
    @if(!in_array($item['animeId'], $blacklist_animeIds))
        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$item['animeId']}}">Add</button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop_{{$item['animeId']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Blacklist Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p style="color: black;">yakin nih mau masukin {{$item['animeId']}} ke dalem blacklist</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="/adding-blacklist">
                @csrf 
  <input type="hidden" name="animeId" value="{{$item['animeId']}}">
  <button type="submit" class="btn btn-danger">Add to Blacklist</button>
</form>

              </div>
            </div>
          </div>
        </div>
@else

        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$item['animeId']}}">Delete</button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop_{{$item['animeId']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Blacklist Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p style="color: black;">yakin nih mau hapus {{$item['animeId']}} dari blacklist</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="/del-blacklist">
                @csrf 
  <input type="hidden" name="animeId" value="{{$item['animeId']}}">
  <button type="submit" class="btn btn-danger">delete from Blacklist</button>
</form>
              </div>
            </div>
          </div>
        </div>
@endif
  </div>
  
</div>
</div>
@endforeach
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

