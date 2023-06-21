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

  <style>
form {
  width: 55vw; /* panjang form, 1/3 lebar browser */
  height: 25vh; /* tinggi form, 1/4 tinggi browser */
  position: absolute; /* membuat form menjadi posisi absolut */
  top: 30%; /* membuat form berada di tengah vertikal */
  left: 50%; /* membuat form berada di tengah horizontal */
  transform: translate(-50%, -50%); /* membuat form berada di tengah pusat */
}

.disabled-input {
  pointer-events: none;
  opacity: 0.6;
}

  </style>

  <body>
  @include('layouts.admin-navbar')

  <form class="row g-3 needs-validation" novalidate action="{{route('enanimupdate')}}" method="POST">
  @csrf

    <input type="hidden" class="form-control" id="id" name="id" value="{{ $anim->id }}" required>

  <div class="col-md-12">
    <label for="animeId" class="form-label">Anime ID</label>
    <input type="text" class="form-control" id="animeId" name="animeId" value="{{ $anim->animeId }}" required>
  </div>

  <div class="col-md-12">
    <label for="animeTitle" class="form-label">Anime Title</label>
    <input type="text" class="form-control" id="animeTitle" name="animeTitle" value="{{ $anim->animeTitle }}" required>

  </div>

  <div class="col-md-12">
    <label for="type" class="form-label">Type</label>
    <input type="text" class="form-control" id="type" name="type" value="{{ $anim->type }}" required>

  </div>

  <div class="col-md-12">
    <label for="animeImg" class="form-label">Anime Image</label>
    <input type="text" class="form-control" id="animeImg" name="animeImg" value="{{ $anim->animeImg }}" required>
  </div>

  <div class="col-md-12">
    <label for="releasedDate" class="form-label">Released Date</label>
    <input type="text" class="form-control" id="releasedDate" name="releasedDate" value="{{ $anim->releasedDate }}" required>
  </div>

  <div class="col-md-12">
    <label for="status" class="form-label">Status</label>
    <input type="text" class="form-control" id="status" name="status" value="{{ $anim->status }}" required>
  </div>

  <div class="col-md-12">
    <label for="genres" class="form-label">Genre</label>
    <input type="text" class="form-control" id="genres" name="genres" value="{{ $anim->genres }}" required>
  </div>

  <div class="col-md-12">
    <label for="otherNames" class="form-label">Other Name</label>
    <input type="text" class="form-control" id="otherNames" name="otherNames" value="{{ $anim->otherNames }}" required>
  </div>

  <div class="col">
  <div class="form-floating">
    <textarea class="form-control" placeholder="Add synopsis here" name="synopsis" id="synopsis" style="height: 500px">{{ $anim->synopsis }}</textarea>
    <label for="synopsis">Synopsis</label>
  </div>
</div>

<div class="col-md-12">
    <label for="totalEpisodes" class="form-label">Total Episode</label>
    <input type="text" class="form-control" id="totalEpisodes" name="totalEpisodes" value="{{ $anim->totalEpisodes }}" required>
  </div>

  <div class="col-12">
    <button class="btn btn-primary" type="submit">Save Changes</button>
  </div>
</form>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>






