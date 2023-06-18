<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
@php
  $page = isset($_GET['page']) && $_GET['page'] != 0 ? $_GET['page'] : 1;
  $next = $page+1;
  $next2 = $next+1;
  $prev = $page-1;
  $prev2 = $prev-1;
@endphp
  @include('layouts.admin-navbar')
  <table class="table">
  <thead id="tableHead">
      <tr>
        <th scope="col">id</th>
        <th scope="col">page</th>
        <th scope="col">animeId</th>
        <th scope="col">animeImg</th>
        <th scope="col">Details</th>
        <th scope="col">Blacklist</th>
        <th scope="col">Min Age</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @php
$i=0;
      @endphp
    @foreach ($popular as $item)
  @if ($item->page == $page)
  @php
  $i++;
  @endphp

    <tr>
      <td>{{ $item->id }}</td>
      <td>{{ $item->page }}</td>
      <td>{{ $item->animeId }}</td>
      <td>
  <img src="{{ $item->animeImg }}" style="max-width: 150px;">
</td>
<td>
  <a href="/en/anime-details/{{ $item->animeId }}" class="btn btn-primary btn-sm">Details</a>
</td>

<td>

@if(!in_array($item['animeId'], $blacklist_animeIds))
@if(!in_array($item['animeId'], $min_age))
        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$item['animeId']}}">Add</button>
@else
<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$item['animeId']}}" disabled>Add</button>
@endif
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop_{{$item['animeId']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Blacklist Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>yakin nih mau masukin {{$item['animeId']}} ke dalem blacklist</p>
                <form method="POST" action="/adding-blacklist">
                @csrf 
  <input type="hidden" name="animeId" value="{{$item['animeId']}}">
  <input class="form-control" name="reason" type="text" placeholder="Enter the reason here">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

  <button type="submit" class="btn btn-danger">Add to Blacklist</button>
</form>

              </div>
            </div>
          </div>
        </div>
@else

        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$item['animeId']}}">Delete</button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop_{{$item['animeId']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Blacklist Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p >yakin nih mau hapus {{$item['animeId']}} dari blacklist</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="/del-blacklist">
                @csrf 
  <input type="hidden" name="animeId" value="{{$item['animeId']}}">
  <button type="submit" class="btn btn-danger">delete from Blacklist</button>
</form>
              </div>
            </div>
          </div>
        </div>
@endif

</td>
<td>

@if(!in_array($item['animeId'], $min_age))
@if(!in_array($item['animeId'], $blacklist_animeIds))
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop2_{{$item['animeId']}}">Set</button>
    @else
    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop2_{{$item['animeId']}}" disabled>Set</button>
    @endif

      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop2_{{$item['animeId']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdrop2Label" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Min Age Confirmation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/adding-minage">
              @csrf 
            <div class="modal-body">
              <p>yakin nih mau masukin {{$item['animeId']}} ke dalem min age</p>
              <input class="form-control" name="minAge" type="text" placeholder="Default input" aria-label="default input example">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      <input type="hidden" name="animeId" value="{{$item['animeId']}}">

      <button type="submit" class="btn btn-danger">Add to Min age</button>
      </form>

            </div>
          </div>
        </div>
      </div>

      @else

        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop3_{{$item['animeId']}}">Delete</button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop3_{{$item['animeId']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Blacklist Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <p>yakin nih mau hapus {{$item['animeId']}} dari blacklist</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form method="POST" action="/del-minage">
                @csrf 
  <input type="hidden" name="animeId" value="{{$item['animeId']}}">
  <button type="submit" class="btn btn-danger">delete from Blacklist</button>
</form>
              </div>
            </div>
          </div>
        </div>
@endif

</td>
      <td>   
        <a href="/en-db-popular/{{ $item->animeId }}/edit" class="btn btn-warning btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>

        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{$item['animeId']}}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop_{{$item['animeId']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Blacklist Confirmation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p >yakin nih mau hapus {{$item['animeId']}} dari popular</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form method="POST" action="{{ route('popular.del') }}">

        @csrf 
<input type="hidden" name="animeId" value="{{$item['animeId']}}">
<button type="submit" class="btn btn-danger">delete from Blacklist</button>
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

  @if (0 == $i)
<center>
<div style="padding-top: 7.5vw;">
  <img src="https://i.ytimg.com/vi/KtjCvVFYKYs/maxresdefault.jpg" height="250px">
</div>

<p>Im sorry {{ Auth::user()->name }} but is seems now more anime on this list</p>
</center>

  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$prev}}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$prev}}">{{$prev}}</a></li>
      <li class="page-item active"><a class="page-link" href="#">{{$page}}</a></li>
      <li class="page-item disabled">
        <a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$next}}">Next</a>
      </li>
    </ul>
  </nav>
  @else
  @if($page==1)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item disabled">
        <a class="page-link">Previous</a>
      </li>
      <li class="page-item active"><a class="page-link" href="#">{{$page}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$next}}">{{$next}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$next2}}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$next}}">Next</a>
      </li>
    </ul>
  </nav>
@elseif($page > 2)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$prev}}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$prev2}}">{{$prev2}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$prev}}">{{$prev}}</a></li>
      <li class="page-item active"><a class="page-link" href="#">{{$page}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$next}}">{{$next}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$next2}}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$next}}">Next</a>
      </li>
    </ul>
  </nav>
  @elseif($page > 1)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$prev}}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$prev}}">{{$prev}}</a></li>
      <li class="page-item active"><a class="page-link" href="#">{{$page}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$next}}">{{$next}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$next2}}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('admin-popular-manage') }}?page={{$next}}">Next</a>
      </li>
    </ul>
  </nav>
@endif
  @endif

  <script>
  document.addEventListener("DOMContentLoaded", function() {
    var table = document.querySelector("table");
    var tableHead = document.getElementById("tableHead");

    if ({{$i}} === 0) {
      table.style.display = "none";
      tableHead.style.display = "none";
    }
  });
</script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
