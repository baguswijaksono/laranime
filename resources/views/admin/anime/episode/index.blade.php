<!doctype html>
@if (Auth::check() && Auth::user()->theme === 'light')
    <html lang="en">
@else
    <html lang="en" data-bs-theme="dark">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Episode List Manage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    @include('layouts.admin-navbar')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">animeId</th>
                <th scope="col">episodeId</th>
                <th scope="col">episodeNum</th>
                <th scope="col">embedUrl</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($epslist as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->animeId }}</td>
                    <td>{{ $item->episodeId }}</td>
                    <td>{{ $item->episodeNum }}</td>
                    <td>{{ $item->embedUrl }}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop2_{{ $item['id'] }}">Edit</button>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop2_{{ $item['id'] }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Episode</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('enepslistedit') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                                            <input class="form-control" value="{{ $item['animeId'] }}" name="animeId"
                                                type="hidden" placeholder="Enter Anime id here">
                                                <div></div>

                                            <label class="form-label">Episode Id</label>
                                            <input class="form-control" value="{{ $item['episodeId'] }}"
                                                name="episodeId" type="text"
                                                placeholder="Enter Anime episode id here">
                                                <label class="form-label">Episode Number</label>
                                            <input class="form-control" value="{{ $item['episodeNum'] }}"
                                                name="episodeNum" type="number"
                                                placeholder="Enter Anime episode number here">
                                                <label class="form-label">Embed Url</label>
                                            <textarea class="form-control" name="embedUrl" placeholder="Enter Anime episode number here">{{ $item['embedUrl'] }}</textarea>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>


                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        </div>



                        <!-- Modal Delete-->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop3_{{ $item['id'] }}">Delete</button>
                        <div class="modal fade" id="staticBackdrop3_{{ $item['id'] }}" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Sure want to delete {{ $item['episodeId'] }} ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <form method="POST" action="{{ route('ep.del') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Delete-->
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
