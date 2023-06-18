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
            <th scope="col">animeId</th>
            <th scope="col">animeTitle</th>
            <th scope="col">animeImg</th>
            <th scope="col">releaseDate</th>
            <th scope="col">Status</th>
            <th scope="col">Genre</th>
            <th scope="col">Other Names</th>
            <th scope="col">Image</th>
            <th scope="col">TotalEps</th>
            <th scope="col">Episode</th>
            <th scope="col">Action</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($endetails as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->animeId }}</td>
              <td>{{ $item->animeTitle }}</td>
              <td>{{ $item->type }}</td>
              <td>{{ $item->releasedDate }}</td>
              <td>{{ $item->status }}</td>
              <td>{{ $item->genres }}</td>
              <td>{{ $item->otherNames }}</td>
              <td><img src="{{ $item->animeImg }}" style="max-width: 50px; width: 35px;"></td>
              <td>{{ $item->totalEpisodes }}</td>
              <td><a href="/en-db-anime/eps/{{ $item->animeId }}" class="btn btn-primary btn-sm">Details</a></td>
              <td>
  <a href="#" class="btn btn-warning btn-sm">Edit</a>
  </td>
  <td>
  <a href="#" class="btn btn-danger btn-sm">Danger</a>
</td>

            </tr>
          @endforeach
        </tbody>
      </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
