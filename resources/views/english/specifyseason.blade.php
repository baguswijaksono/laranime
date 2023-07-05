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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
  @include('layouts.navbar')
  @php
    $url = url()->current();
    $segments = explode('/', $url);
    $anime = end($segments);
    $nama = str_replace("-", " ", $anime);
@endphp

<div class="p-4">
    <select id="seasonSelect" class="form-select" aria-label="Default select example">
        <option selected>{{$nama}}</option>
        @php
        $uniqueSeasons = array_unique($season->pluck('type')->toArray());
        @endphp
        @foreach($uniqueSeasons as $musim)
        @php
        $musim = str_replace(" ", "-", $musim);
        $namamusim = str_replace("-", " ", $musim);
        @endphp
        <option value="{{$musim}}">{{$namamusim}}</option>
        @endforeach
    </select>
</div>

<center>
@foreach($all as $item)
          @if(!in_array($item->animeId, $blacklist_animeIds))
            @if(!in_array($item->animeId, $minagelist))
              @include('layouts.anime-card', [
                'animeId' => $item->animeId,
                'animeTitle' => $item->animeTitle,
                'animeImg' => $item->animeImg,
                'status' => $item->releasedDate,
              ])
            @else
              @php
                $minAge = \App\Models\MinAge::where('animeId', $item->animeId)->value('minAge');
              @endphp
              @if($age > $minAge)
                @include('layouts.anime-card', [
                  'animeId' => $item->animeId,
                  'animeTitle' => $item->animeTitle,
                  'animeImg' => $item->animeImg,
                  'status' => $item->releasedDate,
                ])
              @endif
            @endif

          @endif
        @endforeach
</center>


</div>


<script>
  // Get the select element
  const select = document.getElementById('seasonSelect');
  select.addEventListener('change', function() {
    // Get the selected value
    const selectedValue = select.value;

    // Redirect to the desired URL based on the selected value
    switch (selectedValue) {
      @foreach($season as $musim)
        @php
          $musimSlug = str_replace(" ", "-", $musim->type);
        @endphp
        case '{{$musimSlug}}':
          window.location.href = '/en/season/{{$musimSlug}}'; // Replace example.com with your domain
          break;
      @endforeach

      default:
        // Handle the default case or add more cases as needed
        break;
    }
  });
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

