<div style="padding-left: 15px; padding-top: 15px; display: inline-block;">
<div class="card" style="width: 15rem;">
<a href="/en/anime-details/{{ $animeId}}">  <img src="{{ $animeImg }}" class="rounded" alt="" style="height: 318px; width: 239px;">
</a>

  <div class="card-body">
    <h6 class="card-title">{{ $animeTitle }}</h6>
    <p class="card-text">{{$status}}</p>
    <a href="/id/anime-details/{{ $animeId}}" class="btn btn-primary btn-sm">Details</a>
    <a href="/id/anime-details/{{ $animeId}}" class="btn btn-primary btn-sm">Add Watchlist</a>
  </div>
  
</div>
</div>
