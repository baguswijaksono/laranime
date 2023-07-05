@php
    $urlrl = request()->url(); 
    $segmentsrl = explode('/', $urlrl); 
    $secondLastSegmentrl = $segmentsrl[count($segmentsrl) - 2];
@endphp
 <style>
  .image-container {
  position: relative;
  display: inline-block;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  opacity: 0;
  transition: opacity 0.3s ease;
}

.overlay-text {
  color: white;
  font-weight: bold;
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  font-size:12px;
  transform: translate(-50%, -50%);
}

.image-container:hover .overlay {
  opacity: 1;
}

 </style>

<div style="padding-left: 15px; padding-top: 15px; display: inline-block;">
<div class="card" style=" width: 175px;">
@if($secondLastSegmentrl=='recent-release')
<a href="/en/watch/{{$animeId}}">
  <div class="image-container" >
    <img src="{{ $animeImg }}" class="rounded" alt="" style="height : 250px; width: 175px;">
    <div class="overlay">
      <p class="overlay-text">{{ $animeTitle }}</p>
    </div>
  </div>
</a>

@else
<a href="/en/anime-details/{{$animeId}}">
  <div class="image-container" >
    <img src="{{ $animeImg }}" class="rounded" alt="" style="height : 250px; width: 175px;">
    <div class="overlay">
      <p class="overlay-text">{{ $animeTitle }}</p>
    </div>
  </div>
</a>

@endif
</a>
  <div class="card-body">
  <h6 style="display: -webkit-box; -webkit-box-orient: vertical; -webkit-line-clamp: 1; overflow: hidden; text-overflow: ellipsis;">{{ $animeTitle }}</h6>
    <p class="card-text">{{$status}}</p>
    @if($secondLastSegmentrl=='recent-release')
    @php
    $animeParts = explode('-', $animeId);
    $animeParts = array_slice($animeParts, 0, -2);
    $animeId = implode('-', $animeParts);
    $item->animeId = $animeId;
@endphp
@endif
    @if (Auth::check() && Auth::user()->theme === 'light')
    <a href="/en/anime-details/{{ $animeId}}" class="btn btn-dark btn-sm">Details</a>
@else
<a href="/en/anime-details/{{ $animeId}}" class="btn btn-light btn-sm">Details</a>
@endif
    @if(!in_array($item->animeId, $watchlist))
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop2_{{$item['animeId']}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-fill" viewBox="0 0 16 16">
  <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/>
</svg></button>
      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop2_{{$item['animeId']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Watch list Confirmation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Sure want to add {{ $animeTitle}} to your Watchlist ?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <form method="POST" action="/adding-watchlist">
              @csrf 
      <input type="hidden" name="animeId" value="{{ $animeId}}">
      <input type="hidden" name="email" value=" {{ Auth::user()->email }}">
      <button type="submit" class="btn btn-primary">Add</button>
      </form>

            </div>
          </div>
        </div>
      </div> 
      @else
      <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$item['animeId']}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg>
              </button>
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop_{{$item['animeId']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete Watchlist Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>Sure want to delete {{ $animeTitle}} from your Watchlist ?</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="/del-watchlist">
                @csrf 
  <input type="hidden" name="animeId" value="{{$animeId}}">
  <input type="hidden" name="email" value=" {{ Auth::user()->email }}">
  <button type="submit" class="btn btn-danger">Delete</button>
</form>
              </div>
            </div>
          </div>
        </div>
<!--endmodal-->

      @endif
      

  </div>
  
</div>
</div>
