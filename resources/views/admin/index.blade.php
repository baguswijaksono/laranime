<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
  @include('layouts.admin-navbar')

  @foreach ($userActivity as $item)
  <div class="p-4">
<div class="card">
  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>"{{$item->content}}"</p>
      <footer class="blockquote-footer">{{$item->userName}} Comented on  <cite title="Source Title">{{$item->episodeId}}</cite>  <p class="card-text"><small class="text-body-secondary">
        
@php
$timestamp = strtotime($item->at);
$current_time = time();
$elapsed_time = $current_time - $timestamp;

if ($elapsed_time < 60) {
    $result = $elapsed_time . " seconds ago";
} elseif ($elapsed_time < 3600) {
    $result = floor($elapsed_time / 60) . " minutes ago";
} elseif ($elapsed_time < 86400) {
    $result = floor($elapsed_time / 3600) . " hours ago";
} else {
    $result = floor($elapsed_time / 86400) . " days ago";
}
 @endphp   
 {{$result}}
    </small></p> </footer>
    </blockquote>
  </div>
</div>
</div>
@endforeach



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>

