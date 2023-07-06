<!doctype html>
@if (Auth::check() && Auth::user()->theme === 'light')
    <html lang="en">
@else
    <html lang="en" data-bs-theme="dark">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blacklist Manage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    @include('layouts.admin-navbar')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @php
        use App\Models\Blacklist;
        $Blacklist = Blacklist::count();
    @endphp
    @if ($Blacklist === 0)

        <center>
            @if ($errors->any())
                <div style="padding-top: 40vh;"></div>
                <div style="max-width: 450px ;" class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @else
                <p style="padding-top: 40vh;">"No Anime have been added yet."</p>
            @endif

        </center>

        <center>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop2">Add
                Blacklist</button>
            @if (Auth::check() && Auth::user()->theme === 'light')
                <a class="btn btn-dark btn-sm" href="/">Browse Some Anime</a>
            @else
                <a class="btn btn-light btn-sm" href="/">Browse Some Anime</a>
            @endif
        </center>

        <!-- Add Genre Modal -->
        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdrop2Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdrop2Label">Add a Blacklist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('blacklist.add') }}">
                        @csrf
                        <div class="modal-body">
                            <label for="exampleFormControlInput1" class="form-label">Anime ID</label>
                            <input class="form-control" name="animeId" type="text" placeholder="Enter the animeId"
                                required>
                            <label for="exampleFormControlInput1" class="form-label">Reason</label>
                            <textarea class="form-control" name="reason" placeholder="Leave the reason" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Add to Blacklist</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <nav class="navbar">
            <div class="container-fluid">
                <a class="navbar-brand"> <button type="button" class="btn btn-primary"
                        data-bs-toggle="modal"data-bs-target="#staticBackdrop2">Add Blacklist</button></a>
                <form class="d-flex" role="search" method="GET" action="">
                    <input class="form-control me-2" type="search" name="animeId" placeholder="Search animeId"
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdrop2Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdrop2Label">Add a Blacklist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('blacklist.add') }}">
                        @csrf
                        <div class="modal-body">
                            <label for="exampleFormControlInput1" class="form-label">Anime ID</label>
                            <input class="form-control" name="animeId" type="text"
                                placeholder="Enter the animeId" required>
                            <label for="exampleFormControlInput1" class="form-label">Reason</label>
                            <textarea class="form-control" name="reason" placeholder="Leave the reason" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Add to Blacklist</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
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
                    @if (isset($_GET['animeId']) && $item->animeId == $_GET['animeId'])
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->animeId }}</td>
                            <td>{{ $item->reason }}</td>
                            <td>
                                <!-- Edit Genre Modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdropedit_{{ $item->id }}">Edit</button>
                                <div class="modal fade" id="staticBackdropedit_{{ $item->id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Blacklist</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('blacklist.edit') }}">
                                                    @csrf
                                                    <label class="form-label">Anime ID</label>
                                                    <input class="form-control" type="text" name="animeId"
                                                        value="{{ $item->animeId }}">
                                                    <label class="form-label">Reason</label>
                                                    <textarea class="form-control" rows="3" name="reason">{{ $item->reason }}</textarea>
                                                    <input type="hidden" name="id"
                                                        value="{{ $item->id }}">
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
                                <!-- Delete Genre Modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop_{{ $item->id }}">Delete</button>
                                <div class="modal fade" id="staticBackdrop_{{ $item->id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Delete Blacklist
                                                    Confirmation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <center>
                                                    <p>You sure you want to delete {{ $item->animeId }} from Blacklist
                                                        ?
                                                    </p>
                                                </center>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <form method="POST" action="{{ route('blacklist.destroy') }}">
                                                    @csrf
                                                    <input type="hidden" name="animeId"
                                                        value="{{ $item->animeId }}">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                    @elseif(!isset($_GET['animeId']))
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->animeId }}</td>
                                <td>{{ $item->reason }}</td>
                                <td>
                                    <!-- Edit Genre Modal -->
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdropedit_{{ $item->id }}">Edit</button>
                                    <div class="modal fade" id="staticBackdropedit_{{ $item->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Blacklist
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('blacklist.edit') }}">
                                                        @csrf
                                                        <label class="form-label">Anime ID</label>
                                                        <input class="form-control" type="text" name="animeId"
                                                            value="{{ $item->animeId }}">
                                                        <label class="form-label">Reason</label>
                                                        <textarea class="form-control" rows="3" name="reason">{{ $item->reason }}</textarea>
                                                        <input type="hidden" name="id"
                                                            value="{{ $item->id }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Save
                                                        Changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Genre Modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop_{{ $item->id }}">Delete</button>
                                    <div class="modal fade" id="staticBackdrop_{{ $item->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Delete Blacklist
                                                        Confirmation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                        <p>You sure you want to delete {{ $item->animeId }} from
                                                            Blacklist ?
                                                        </p>
                                                    </center>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <form method="POST" action="{{ route('blacklist.destroy') }}">
                                                        @csrf
                                                        <input type="hidden" name="animeId"
                                                            value="{{ $item->animeId }}">
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>

                            </tr>
                    @endif
                @endforeach

            </tbody>
        </table>


    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
