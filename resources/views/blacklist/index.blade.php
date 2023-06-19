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

    @if(!isset($blacklist) || empty($blacklist))
      <p>No genres available.</p>
    @else
      <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">animeId</th>
            <th scope="col">reason</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($blacklist as $item)
            <tr>
              <td>{{ $item->id }}</td>
              <td>{{ $item->animeId }}</td>
              <td>{{ $item->reason }}</td>
              <td>
                <!-- Edit Genre Modal -->
                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdropedit_{{ $item->id }}">Edit</button>
                <div class="modal fade" id="staticBackdropedit_{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Edit Blacklist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      <form method="POST" action="{{ route('blacklist.edit') }}">
                          @csrf
                          <label class="form-label">Anime ID</label>
                          <input class="form-control" type="text" name="animeId" value="{{ $item->animeId }}">
                          <label class="form-label">Reason</label>
                          <textarea class="form-control" rows="3" name="reason">{{ $item->reason }}</textarea>
                          <input type="hidden" name="id" value="{{ $item->id }}">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-success">Save Changes</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Delete Genre Modal -->
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{ $item->id }}">Delete</button>
                <div class="modal fade" id="staticBackdrop_{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Delete Blacklist Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure you want to delete {{ $item->animeId }} from Blacklist?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('blacklist.destroy') }}">
                          @csrf
                          <input type="hidden" name="animeId" value="{{ $item->animeId }}">
                          <button type="submit" class="btn btn-danger">Delete from genres</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

              </td>

            </tr>
          @endforeach
        </tbody>
      </table>

      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Add Blacklist</button>

      <!-- Add Genre Modal -->
      <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdrop2Label">Adding Blacklist Confirmation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('blacklist.add') }}">
              @csrf
              <div class="modal-body">
              <label for="exampleFormControlInput1" class="form-label">Anime ID</label>
                <input class="form-control" name="animeId" type="text" placeholder="Enter the animeId">
                <label for="exampleFormControlInput1" class="form-label">Reason</label>
                <input class="form-control" name="reason" type="text" placeholder="Enter the reason">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Add to Blacklist</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>
