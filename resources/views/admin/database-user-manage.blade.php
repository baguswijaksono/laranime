<!doctype html>
<html lang="en" data-bs-theme="dark">
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
  <a href="#" class="btn btn-primary">Set Admin</a>
  <a href="#" class="btn btn-warning">Ban</a>
  <a href="#" class="btn btn-danger">Delete</a>
</td>

            </tr>
          @endforeach
        </tbody>
      </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
