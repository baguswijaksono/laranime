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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>
    @include('layouts.admin-navbar')
      <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">email</th>
            <th scope="col">name</th>
            <th scope="col">Date of Birth</th>
            <th scope="col">role</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($User as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->date_of_birth }}</td>
              <td>{{ $item->role }}</td>
              <td>
                <!-- Modal -->
              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop3{{ $item->id }}">Promote</button>
<div class="modal fade" id="staticBackdrop3{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Blacklist Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>yakin nih mau hapus dari blacklist</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form method="POST" action="{{route('adminPromote')}}">
        @csrf 
<input type="hidden" name="email" value="{{ $item->email }}">
<button type="submit" class="btn btn-danger">Promote</button>
</form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
                  <!-- Modal -->
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop4{{ $item->id }}">Delete</button>
<div class="modal fade" id="staticBackdrop4{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Blacklist Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>yakin nih mau hapus dari blacklist</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form method="POST" action="{{route('delUser')}}">
        @csrf 
<input type="hidden" name="email" value="{{ $item->email }}">
<button type="submit" class="btn btn-danger">Promote</button>
</form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
</td>

            </tr>
          @endforeach
        </tbody>
      </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
