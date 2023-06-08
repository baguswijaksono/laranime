<div style="padding-left: 15px; padding-top: 15px; display: inline-block;">
<div class="card" style="width: 15rem;">
<a href="/en/anime-details/{{ $animeId}}">  <img src="{{ $animeImg }}" class="rounded" alt="" style="height: 318px; width: 239px;">
</a>

  <div class="card-body">
    <h6 class="card-title">{{ $animeTitle }}</h6>
    <p class="card-text">{{$status}}</p>
    <a href="/en/anime-details/{{ $animeId}}" class="btn btn-primary btn-sm">Details</a>
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop2_{{$item['animeId']}}">Add to watchlist</button>

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop2_{{$item['animeId']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Watch list Confirmation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p style="color: black;">yakin nih mau masukin {{ $animeId}}  ke dalem min age</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <form method="POST" action="/adding-watchlist">
              @csrf 
      <input type="hidden" name="animeId" value="{{ $animeId}}">
      <input type="hidden" name="email" value=" {{ Auth::user()->email }}">
      <button type="submit" class="btn btn-danger">Add</button>
      </form>

            </div>
          </div>
        </div>
      </div>
  </div>
  
</div>
</div>
