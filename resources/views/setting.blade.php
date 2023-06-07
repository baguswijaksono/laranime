<!doctype html>
<html lang="en" data-bs-theme="dark">
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

  <form class="row g-3 needs-validation" novalidate>
  <div class="col-md-8">
    <label for="validationCustom01" class="form-label">Full name</label>
    <input type="text" class="form-control" id="validationCustom01" value="{{ Auth::user()->name }}" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-4">
  <label for="start" class="form-label">Date of birth</label>
  <input class="form-control" type="date" id="start" name="trip-start"
       value="2018-07-22"
       min="2018-01-01" max="2018-12-31">

</div>


  <div class="col-md-9">
    <label for="validationCustom03" class="form-label">Email</label>
    <input type="text" class="form-control" id="validationCustom03" value="{{ Auth::user()->email }}" required>
    <div class="invalid-feedback">
      Please provide a valid city.
    </div>
  </div>

  <div class="col-md-3">
    <label for="validationCustom05" class="form-label">Theme</label>
    <select class="form-select" aria-label="Default select example">
  <option selected>{{ Auth::user()->theme }}</option>
  <option value="dark">Dark</option>
  <option value="light">Light</option>
</select>
  </div>
  
  <div class="col-12">
  <label for="inputPassword5" class="form-label">Password</label>
<input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock">
<div id="passwordHelpBlock" class="form-text">
  Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
</div>
</div>
  <div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
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






