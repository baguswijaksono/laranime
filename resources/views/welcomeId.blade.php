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

  <center>  <h1  style="    padding-top: 30px; padding-bottom: 30px;">Ongoing Anime</h1></center>
<div style="display: inline-block; overflow: hidden;">
  <div class="row row-cols-auto">
    @php $counter = 0; @endphp
    @foreach($data['data']['ongoing_anime'] as $item)
      @if(!in_array($item['slug'], $blacklist_animeIds))
        @if($counter < 24)
          <div class="col">
            <div class="kartu">
              <div class="badge bg-danger text-wrap">
                Diperbarui ke {{ $item['current_episode'] }}
              </div>
              <a href="/en/watch/">
  <img src="{{ $item['poster'] }}" class="image rounded float-start" alt="...">
</a>
            </div>
            <dt style="max-width: 166.5px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{$item['title']}}</dt>
            <dd>{{ $item['release_day'] }} , {{ $item['newest_release_date'] }} </dd>
          </div>
          @php $counter++; @endphp
        @else
          @break
        @endif
      @endif
    @endforeach
  </div>
</div>


  </div>
</div>

  <!-- This is a comment in HTML -->

  <center>  <h1  style="    padding-top: 30px; padding-bottom: 30px;">Complete Anime</h1></center>
<div style="display: inline-block; overflow: hidden;">
  <div class="row row-cols-auto">
    @php $counter = 0; @endphp
    @foreach($data['data']['complete_anime'] as $item)
      @if(!in_array($item['slug'], $blacklist_animeIds))
        @if($counter < 24)
          <div class="col">
            <div class="kartu">
              <div class="badge bg-success text-wrap">
                {{ $item['rating'] }}
              </div>
              <a href="/en/watch/">
  <img src="{{ $item['poster'] }}" class="image rounded float-start" alt="...">
</a>

            </div>
            <dt style="max-width: 166.5px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{$item['title']}}</dt>
            <dd>Total Episode :  {{ $item['episode_count'] }}</dd>
          </div>
          @php $counter++; @endphp
        @else
          @break
        @endif
      @endif
    @endforeach
  </div>
</div>


  </div>
</div>



		
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

