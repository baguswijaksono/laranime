<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    @include('layouts.navbar')
    @php
    use App\Models\History;
    $email = Auth::user()->email;
    $userHistoryCount = History::where('email', $email)->count();
@endphp

    @if($userHistoryCount === 0)
      <p>No genres available.</p>
    @else
    <div class="container text-center">
  <div class="row row-cols-4 row-cols-lg-5 g-2 g-lg-3">
    @foreach ($history->sortByDesc('id') as $item)
    @php
    $url = $item->url;
    $parts = explode('/', $url);
    $trimmedUrl = last($parts);
    $formattedString = str_replace("-", " ", $trimmedUrl);
$formattedString = ucwords($formattedString);
    @endphp


    <div class="col">
  <a href="{{$item->url}}">
    <div class="card" style="max-width: 18rem;">
      <iframe style="max-width: 18rem;" id="myIframe" src="https://player.anikatsu.me/?id={{$trimmedUrl}}" allowfullscreen="false" frameborder=""></iframe>
      <div class="card-body">
        <p style="text-decoration: none;">{{$formattedString}}</p>
      </div>
    </div>
  </a>
</div>






@endforeach
</div>
</div>

    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
