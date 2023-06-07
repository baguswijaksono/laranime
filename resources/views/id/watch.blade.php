@php
$url = url()->current();
$segments = explode('/', $url);
$lastSegment = end($segments);
@endphp

<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nonton {{ $data["data"]["episode"]}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <style>
		.scrollable {
			width: 435x;
			height: 575px;
			overflow-y: scroll;
		}

    .scrollable::-webkit-scrollbar {
  width: 0px;
}


	</style>
  <body>


  @include('layouts.navbar')
  @if(isset($data))
  <div style="padding-top: 15px;">
  <ul style="display: flex;align-items: flex-start; justify-content: center; list-style: none;">
  <li>
  <div class="jendala-stream">
  <iframe width="1056" height="594" src="{{ $data["data"]["stream_url"]}}" allowfullscreen></iframe>
  @php
  $episode_pos = strstr($data["data"]["episode"], "Episode");
if ($episode_pos !== false) {
    $title = substr($data["data"]["episode"], 0, strpos($data["data"]["episode"], $episode_pos));
} else {
    $title = $details['synopsis'];
}
  @endphp
  <h1>{{ $title}} </h1>
<div class="genre-list">
@foreach($details['data']['genres'] as $genre)
  <a href="/id/genre/{{ $genre['slug'] }}/1" class="btn btn-secondary btn-sm">{{ $genre['name'] }}</a>
@endforeach 

</div>
<div style="padding-top: 15px;">
<div class="sinopsis"style='max-width: 1056px;'>
<div class="alert alert-dark" role="alert">
{{ $details['data']['synopsis'] }}
</div>
</div>

<div class="Comments"style='max-width: 1056px;'>
            <div class="card">
                <div class="p-3">
                    <h6>Comments</h6>
                <div class="mt-3 d-flex flex-row align-items-center p-3 form-color"> <img src="https://i.imgur.com/zQZSWrt.jpg" width="50" class="rounded-circle mr-2"> <input type="text" class="form-control" placeholder="Enter your comment..."> </div>
                <div class="mt-2">

                    <div class="d-flex flex-row p-3"> <img src="" width="40" height="40" class="rounded-circle mr-3">
                        <div class="w-100">
                            <div class="d-flex justify-content-between align-items-center">
<h6>Example heading <span class="badge bg-primary">New</span></h6> <small>2h ago</small>
                            </div>
                            <p class="text-justify comment-text mb-0">Tellus in hac habitasse platea dictumst vestibulum. Lectus nulla at volutpat diam ut venenatis tellus. Aliquam etiam erat velit scelerisque in dictum non consectetur. Sagittis nisl rhoncus mattis rhoncus urna neque viverra justo nec. Tellus cras adipiscing enim eu turpis egestas pretium aenean pharetra. Aliquam faucibus purus in massa.</p>
                            <p>
  <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    4 Reply
  </a>

</p>
<div class="collapse" id="collapseExample">


<div class="Comments"style='max-width: 1056px;'>

                    <div class="d-flex flex-row p-3"> <img src="" width="40" height="40" class="rounded-circle mr-3">
                        <div class="w-100">
                            <div class="d-flex justify-content-between align-items-center">
<h6>Example heading <span class="badge bg-secondary">New</span></h6> <small>2h ago</small>
                            </div>
                            <p class="text-justify comment-text mb-0">Tellus in hac habitasse platea dictumst vestibulum. Lectus nulla at volutpat diam ut venenatis tellus. Aliquam etiam erat velit scelerisque in dictum non consectetur. Sagittis nisl rhoncus mattis rhoncus urna neque viverra justo nec. Tellus cras adipiscing enim eu turpis egestas pretium aenean pharetra. Aliquam faucibus purus in massa.</p>
                            
                       



</div>
                       
                          </div>
                    </div>
                </div>
            </div>
                </div>

  </div>
  </li>
  <li>
    <h2 style="padding-left: 35px;">Episode List</h2>
<ul>

@if(count($details['data']['episode_lists']) >= 15)
  <div class="scrollable">
@endif
<div class="list-group">
@foreach($details['data']['episode_lists'] as $key => $episode)

  @if($episode['episode'] == $data["data"]["episode"])
  <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
  {{ $episode['episode'] }}
  </a>
  @else

  <a href="/id/watch/full-alchemist-brotherhood-subtitle-indonesia/63" class="list-group-item list-group-item-action">{{ $episode['episode'] }}</a>
  @endif

@endforeach
</div>

@if(count($details['data']['episode_lists']) >= 15)
  </div>
@endif


<h2 style="padding-top: 15px;padding-bottom: 15px;">Rekomendasi</h2>
@foreach($details['data']['recommendations'] as $rekomendasi)
    <div class="card mb-3" style="max-width: 400px;">
      <div class="row g-0">
        <div class="col-md-4">
          <a href="/en/anime-details/{{$rekomendasi['slug']}}">
            <img src="{{$rekomendasi['poster']}}" class="img-fluid rounded-start" alt="...">
          </a>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">{{$rekomendasi['title']}}</h5>
          </div>
        </div>
      </div>
    </div>
@endforeach



</li>
</ul>
</div>
@endif

</ul>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

