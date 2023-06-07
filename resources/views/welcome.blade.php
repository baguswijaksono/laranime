<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laranime - Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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

    .image {
      max-width: 166.5px;
      max-height: 250px;
    object-fit: cover;
    }
  </style>
  </head>
  <body>
  @include('layouts.navbar')

  <!-- This is a comment in HTML -->
<center><h1  style="    padding-top: 30px; padding-bottom: 30px;">Popular</h1></center>
<div style="display: inline-block; overflow: hidden;">
  <div class="row row-cols-auto">
    @php $counter = 0; @endphp
    @foreach($data as $item)
      @if(!in_array($item['animeId'], $blacklist_animeIds))
        @if($counter < 8)
          <div class="col">
            <div class="kartu">
              <div class="badge bg-primary text-wrap">
                Popular
              </div>
              <a href="/en/anime-details/{{ $item['animeId'] }}">
  <img src="{{ $item['animeImg'] }}" class="image rounded float-start" alt="...">
</a>

            </div>
            <dt style="max-width: 166.5px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{$item['animeTitle']}}</dt>
            <dd>{{$item['releasedDate']}}</dd>
          </div>
          @php $counter++; @endphp
        @else
          @break
        @endif
      @endif
    @endforeach
  </div>
</div>

<!-- This is a comment in HTML -->

  <!-- This is a comment in HTML -->
<center>  <h1  style="    padding-top: 30px; padding-bottom: 30px;">Recent Release</h1></center>
<div style="display: inline-block; overflow: hidden;">
  <div class="row row-cols-auto">
    @php $counter2 = 0; @endphp
    @foreach($data2 as $item2)
      @if(!in_array($item2['animeId'], $blacklist_animeIds))
        @if($counter2 < 8)
          <div class="col">
            <div class="kartu">
              <div class="badge bg-danger text-wrap">
                Updated to Episode {{$item2['episodeNum']}}
              </div>
              <a href="/en/watch/{{ $item2['episodeId'] }}">
  <img src="{{ $item2['animeImg'] }}" class="image rounded float-start" alt="...">
</a>

            </div>
            <dt style="max-width: 166.5px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{$item2['animeTitle']}}</dt>
            <dd>Type : {{$item2['subOrDub']}}</dd>
          </div>
          @php $counter2++; @endphp
        @else
          @break
        @endif
      @endif
    @endforeach
  </div>
</div>

<!-- This is a comment in HTML -->

<center><h1  style="    padding-top: 30px; padding-bottom: 30px;">Movies</h1></center>
<div style="display: inline-block; overflow: hidden;">
  <div class="row row-cols-auto">
    @php $counter3 = 0; @endphp
    @foreach($data3 as $item3)
      @if(!in_array($item3['animeId'], $blacklist_animeIds))
        @if($counter3 < 8)
          <div class="col">
            <div class="kartu">
              <div class="badge bg-warning text-wrap">
                Movie
              </div>
              <a href="/en/watch/{{ $item3['animeId'] }}">
  <img src="{{ $item3['animeImg'] }}" class="image rounded float-start" alt="...">
</a>

            </div>
            <dt style="max-width: 166.5px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{$item3['animeTitle']}}</dt>
            <dd>{{$item3['releasedDate']}}</dd>
          </div>
          @php $counter3++; @endphp
        @else
          @break
        @endif
      @endif
    @endforeach
  </div>
</div>
<!-- This is a comment in HTML -->

<center>  <h1  style="    padding-top: 30px; padding-bottom: 30px;">Top Airing</h1></center>
<div style="display: inline-block; overflow: hidden;">
  <div class="row row-cols-auto">
    @php $counter4 = 0; @endphp
    @foreach($data4 as $item4)
      @if(!in_array($item4['animeId'], $blacklist_animeIds))
        @if($counter4 < 8)
          <div class="col">
            <div class="kartu">
              <div class="badge bg-success text-wrap">
              {{$item4['latestEp']}}
              </div>
              <a href="/en/anime-details/{{$item4['animeId']}}">
  <img src="{{ $item4['animeImg'] }}" class="image rounded float-start" alt="...">
</a>

            </div>
            <dt style="max-width: 166.5px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{$item4['animeTitle']}}</dt>
           
          </div>
          @php $counter4++; @endphp
        @else
          @break
        @endif
      @endif
    @endforeach
  </div>
</div>


		
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

