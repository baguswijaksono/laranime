<!doctype html>
@if (Auth::check() && Auth::user()->theme === 'light')
<html lang="en">
@else
<html lang="en" data-bs-theme="dark">
@endif

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Popular Anime - Page </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
  @include('layouts.navbar')
  <div style="display: inline-block;">

    <center>
      @foreach($data as $item)
      @if(!in_array($item->animeId, $blacklist_animeIds))
      @if(!in_array($item->animeId, $minagelist))
      @include('layouts.anime-card', [
      'animeId' => $item->animeId,
      'animeTitle' => $item->animeTitle,
      'animeImg' => $item->animeImg,
      'status' => $item->latestEp,
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
  @include('layouts.pagination')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>