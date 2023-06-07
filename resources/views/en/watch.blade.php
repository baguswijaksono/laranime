<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Watch {{$details['animeTitle']}} -  Episode {{$episode_number}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <style>
		.scrollable {
			width: 435x;
			height: 550px;
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
  <div class="ratio ratio-16x9">
  <iframe src="{{ $data['Referer'] }}" title="{{ $details['animeTitle'] }}" allowfullscreen></iframe>
</div>
  
  <h1>{{ $details['animeTitle'] }} </h1>
<div class="genre-list">
@foreach($details['genres'] as $genre)
<a href="/en/genre/{{ str_word_count($genre) > 1 ? str_replace(' ', '-', strtolower($genre)) : strtolower($genre) }}/1" class="btn btn-secondary btn-sm" >{{ $genre }}</a>
  {{-- operator ternary ?: untuk melakukan pengecekan apakah elemen saat ini memiliki 
    jumlah kata lebih dari satu. 
    
    Jika ya, maka kita mengganti spasi dengan tanda - menggunakan str_replace() 
    dan membuat string menjadi lowercase menggunakan strtolower(). 
    
    Jika tidak, maka elemen akan tetap sama dan 
    lowercase juga diaplikasikan menggunakan strtolower().
--}}
@endforeach
</div>
<div style="padding-top: 15px;">
<div class="sinopsis"style='max-width: 1056px;'>
<div class="alert alert-dark" role="alert">
{{ $details['synopsis'] }}
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

@if(count($details['episodesList']) >= 65)
  <div class="scrollable">
@endif

@foreach($details['episodesList'] as $key => $episode)
  @if($episode['episodeNum'] == $episode_number)
      <a href="#" class="btn btn-success" style="width: 75px;">{{ $episode['episodeNum'] }}</a>
  @else
      <a href="/en/watch/{{ $episode['episodeId'] }}" class="btn btn-secondary" style="width: 75px">{{ $episode['episodeNum'] }}</a>
  @endif

  @if(($key+1) % 5 == 0)
      <div style="padding-bottom: 5px;"></div>
  @endif
@endforeach

@if(count($details['episodesList']) >= 65)
  </div>
@endif


<h2 style="padding-top: 15px;padding-bottom: 15px;">Rekomendasi</h2>
@foreach($recs as $rekomendasi)
  @if($rekomendasi['animeTitle'] !== $details['animeTitle'])
    <div class="card mb-3" style="max-width: 400px;">
      <div class="row g-0">
        <div class="col-md-4">
          <a href="/en/anime-details/{{$rekomendasi['animeId']}}">
            <img src="{{$rekomendasi['animeImg']}}" class="img-fluid rounded-start" alt="...">
          </a>
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title">{{$rekomendasi['animeTitle']}}</h5>
            <p class="card-text"><small class="text-muted"></small>{{$rekomendasi['status']}}</p>
          </div>
        </div>
      </div>
    </div>
  @endif
@endforeach



</li>
</ul>
</div>
@endif

</ul>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>

