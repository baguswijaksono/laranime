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
$previousLetter = '';
@endphp

<ul class="list-group p-4">
@foreach($all as $item)
  @php
  $currentLetter = substr($item->animeId, 0, 1);
  @endphp

  @if ($currentLetter !== $previousLetter)
    @if ($currentLetter === 'a')
      <h1>A</h1>
    @elseif ($currentLetter === 'b')
      <h1>B</h1>
    @elseif ($currentLetter === 'c')
      <h1>C</h1>
    @elseif ($currentLetter === 'd')
      <h1>D</h1>
    @elseif ($currentLetter === 'e')
      <h1>E</h1>
    @elseif ($currentLetter === 'f')
      <h1>F</h1>
      @elseif ($currentLetter === 'g')
  <h1>G</h1>
@elseif ($currentLetter === 'h')
  <h1>H</h1>
@elseif ($currentLetter === 'i')
  <h1>I</h1>
@elseif ($currentLetter === 'j')
  <h1>J</h1>
@elseif ($currentLetter === 'k')
  <h1>K</h1>
@elseif ($currentLetter === 'l')
  <h1>L</h1>
@elseif ($currentLetter === 'm')
  <h1>M</h1>
@elseif ($currentLetter === 'n')
  <h1>N</h1>
@elseif ($currentLetter === 'o')
  <h1>O</h1>
@elseif ($currentLetter === 'p')
  <h1>P</h1>
@elseif ($currentLetter === 'q')
  <h1>Q</h1>
@elseif ($currentLetter === 'r')
  <h1>R</h1>
@elseif ($currentLetter === 's')
  <h1>S</h1>
@elseif ($currentLetter === 't')
  <h1>T</h1>
@elseif ($currentLetter === 'u')
  <h1>U</h1>
@elseif ($currentLetter === 'v')
  <h1>V</h1>
@elseif ($currentLetter === 'w')
  <h1>W</h1>
@elseif ($currentLetter === 'x')
  <h1>X</h1>
@elseif ($currentLetter === 'y')
  <h1>Y</h1>
@elseif ($currentLetter === 'z')
  <h1>Z</h1>
@endif

    @php
    $previousLetter = $currentLetter;
    @endphp
  @endif

  <li class="list-group-item d-flex justify-content-between align-items-center ">
  <a class="fs-6" href="/en/anime-details/{{$item->animeId}}">{{$item->animeTitle}}</a>
  @if ($item->status == 'Completed')
    <span class="badge bg-primary rounded">Completed</span>
@elseif ($item->status == 'Ongoing')
<span class="badge bg-success rounded">Ongoing</span>
@else
    {{-- Handle other cases if needed --}}
@endif

  </li>
@endforeach



</ul>

</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

