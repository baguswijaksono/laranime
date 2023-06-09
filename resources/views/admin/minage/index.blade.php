<!doctype html>
@if (Auth::check() && Auth::user()->theme === 'light')
    <html lang="en">
@else
    <html lang="en" data-bs-theme="dark">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Minimum Age Manage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    @include('layouts.admin-navbar')
    @php
        use App\Models\MinAge;
        $MinAge = MinAge::count();
    @endphp
    @if ($MinAge === 0)
        <div class="tengahin" style="height:40vh"></div>
        <center>
            <p>"No Anime have been set with minimum age yet."</p>
        </center>

        <center>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                data-bs-target="#staticBackdrop2">Set Minimum Age</button>
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
                        <h5 class="modal-title" id="staticBackdrop2Label">Add Minimum Age</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('minage.add') }}">
                        @csrf
                        <div class="modal-body">
                            <label for="exampleFormControlInput1" class="form-label">Anime ID</label>
                            <input class="form-control" name="animeId" type="text" placeholder="Enter the animeId"
                                required>
                            <label for="exampleFormControlInput1" class="form-label">Minimum Age Requirement</label>
                            <input class="form-control" name="minAge" type="number" placeholder="Set the Minimum Age"
                                required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Set</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @else
        <nav class="navbar">
            <div class="container-fluid">
                <a class="navbar-brand"> <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop2">Set Minimum Age</button></a>
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
                        <h5 class="modal-title" id="staticBackdrop2Label">Add Minimum Age</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('minage.add') }}">
                        @csrf
                        <div class="modal-body">
                            <label for="exampleFormControlInput1" class="form-label">Anime ID</label>
                            <input class="form-control" name="animeId" type="text" placeholder="Enter the animeId"
                                required>
                            <label for="exampleFormControlInput1" class="form-label">Minimum Age Requirement</label>
                            <input class="form-control" name="minAge" type="number"
                                placeholder="Set the Minimum Age" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Set</button>
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
                    <th scope="col">minage</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($minAge as $item)
                    @if (isset($_GET['animeId']) && $item->animeId == $_GET['animeId'])
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->animeId }}</td>
                            <td>{{ $item->minAge }}</td>
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
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Minimum Age
                                                    Requirement</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('minage.edit') }}">
                                                    @csrf
                                                    <label class="form-label">Anime ID</label>
                                                    <input class="form-control" type="text" name="animeId"
                                                        value="{{ $item->animeId }}">
                                                    <label class="form-label">Minimum Age Requirement</label>
                                                    <input class="form-control" type="number" name="minAge"
                                                        value="{{ $item->minAge }}">
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
                                    data-bs-target="#staticBackdrop_{{ $item->id }}">Unset</button>
                                <div class="modal fade" id="staticBackdrop_{{ $item->id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Unset Minimum Age
                                                    Requirement</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <center>
                                                    <p>Are you sure you want unset {{ $item->animeId }} minimum age
                                                        requirement ?</p>
                                                </center>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <form method="POST" action="{{ route('minage.destroy') }}">
                                                    @csrf
                                                    <input type="hidden" name="animeId"
                                                        value="{{ $item->animeId }}">
                                                    <button type="submit" class="btn btn-danger">Delete from
                                                        genres</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>

                        </tr>
                    @elseif (!isset($_GET['animeId']))
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->animeId }}</td>
                            <td>{{ $item->minAge }}</td>
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
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Minimum Age
                                                    Requirement</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('minage.edit') }}">
                                                    @csrf
                                                    <label class="form-label">Anime ID</label>
                                                    <input class="form-control" type="text" name="animeId"
                                                        value="{{ $item->animeId }}">
                                                    <label class="form-label">Minimum Age Requirement</label>
                                                    <input class="form-control" type="number" name="minAge"
                                                        value="{{ $item->minAge }}">
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
                                    data-bs-target="#staticBackdrop_{{ $item->id }}">Unset</button>
                                <div class="modal fade" id="staticBackdrop_{{ $item->id }}"
                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Unset Minimum Age
                                                    Requirement</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <center>
                                                    <p>Are you sure you want unset {{ $item->animeId }} minimum age
                                                        requirement ?</p>
                                                </center>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <form method="POST" action="{{ route('minage.destroy') }}">
                                                    @csrf
                                                    <input type="hidden" name="animeId"
                                                        value="{{ $item->animeId }}">
                                                    <button type="submit" class="btn btn-danger">Delete from
                                                        genres</button>
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
