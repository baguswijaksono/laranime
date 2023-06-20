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
  width: 33.33vw; /* panjang form, 1/3 lebar browser */
  height: 25vh; /* tinggi form, 1/4 tinggi browser */
  position: absolute; /* membuat form menjadi posisi absolut */
  top: 40%; /* membuat form berada di tengah vertikal */
  left: 50%; /* membuat form berada di tengah horizontal */
  transform: translate(-50%, -50%); /* membuat form berada di tengah pusat */
}
  </style>

  <body>
  @include('layouts.navbar')
  @if (Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@endif

  <form class="row g-3 needs-validation" novalidate action="{{route('updateUser')}}" method="POST">
  @csrf
  <div class="col-md-8">
    <label for="validationCustom01" class="form-label">Full name</label>
    <input type="text" class="form-control" id="validationCustom01" name="validationCustom01" value="{{ Auth::user()->name }}" required>

    
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-4">
  <label for="start" class="form-label">Date of birth</label>
  <input class="form-control" type="date" id="start" name="trip-start"
       value="{{ Auth::user()->date_of_birth }}"
       min="2018-01-01" max="2018-12-31">

</div>


  <div class="col-md-12">
    <label for="validationCustom03" class="form-label">Email</label>
    <input type="text" class="form-control" id="validationCustom03" name="validationCustom03" value="{{ Auth::user()->email }}" required>
    <div class="invalid-feedback">
      Please provide a valid email.
    </div>
  </div>


  </div>

  <div class="col-12">
    <button class="btn btn-primary" type="submit">Save Changes</button>
  </div>
</form>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>






