<!doctype html>
@if (Auth::check() && Auth::user()->theme === 'light')
    <html lang="en">
@else
    <html lang="en" data-bs-theme="dark">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Setting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<style>
    form {
        width: 33.33vw;
        /* panjang form, 1/3 lebar browser */
        height: 25vh;
        /* tinggi form, 1/4 tinggi browser */
        position: absolute;
        /* membuat form menjadi posisi absolut */
        top: 40%;
        /* membuat form berada di tengah vertikal */
        left: 50%;
        /* membuat form berada di tengah horizontal */
        transform: translate(-50%, -50%);
        /* membuat form berada di tengah pusat */
    }
</style>

<body>
    @include('layouts.navbar')
    @if (session('message'))
    <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
@endif

@if ($errors->any())
<ul class="alert alert-danger">
    @foreach ($errors->all() as $error)
    <li class="text-danger">{{ $error }}</li>
    @endforeach
</ul>
@endif

    <form class="row g-3 needs-validation" novalidate action="{{ route('saveChangePassword') }}" method="POST">
        @csrf
        <div class="col-md-12">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" class="form-control" name="current_password" required>
        </div>

        <div class="col-md-12">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>

        <div class="col-md-12">
            <label for="password" class="form-label">New Password Confirmation</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>


        <div class="col-12">
            <button class="btn btn-dark" type="submit">Save Changes</button>   
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
