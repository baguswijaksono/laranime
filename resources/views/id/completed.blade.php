@php 
$url = url()->current(); // URL yang ingin diproses
$path = parse_url($url, PHP_URL_PATH); // mendapatkan bagian path dari URL
$path_components = explode("/", $path); // memecah path menjadi array
$acpg = end($path_components); // mengambil elemen terakhir dari array
$acgn = $path_components[count($path_components) - 2];
$prevPage = $acpg - 1;
$nextPage = $acpg + 1;
$totalPage = 500;
@endphp

<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recent Release - Page {{$acpg}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
  @include('layouts.navbar')
  <div style="display: inline-block;">
@foreach($data['data'] as $item)
  @if(!in_array($item['title'], $blacklist_animeIds))
    @include('layouts.anime-cardid', [
      'animeId' => $item['slug'],
      'animeTitle' => $item['title'],
      'animeImg' => $item['poster'],
      'status' => 'Total Episode : '.$item['episode_count'],
    ])
  @endif
@endforeach
</div>
@include('layouts.exclude-genre-pagination', [
  'acpg' => $acpg,
  'acgn' => $acgn,
  'totalPage' => 500,
  'prevPage' => $acpg - 1,
  'nextPage' => $acpg + 1,
])
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

