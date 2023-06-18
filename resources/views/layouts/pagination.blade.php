@php
    $url = request()->url(); 
    $segments = explode('/', $url); 
    $lastSegment = last($segments); 
    $next = $lastSegment + 1;
    $next2 = $lastSegment + 2;
    $prev = $lastSegment - 1;
    $prev2 = $lastSegment - 2;
    $secondLastSegment = $segments[count($segments) - 2];
@endphp

@if($secondLastSegment=='popular')
<div class="p-2"></div>
@if($lastSegment==1)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item disabled">
        <a class="page-link">Previous</a>
      </li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userPopular', ['page' => $next]) }}">{{ $next }}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userPopular', ['page' => $next2]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userPopular', ['page' => $next]) }}">Next</a>
      </li>
    </ul>
  </nav>
@elseif($lastSegment > 2)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="{{ route('userPopular', ['page' => $prev]) }}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('userPopular', ['page' => $prev2]) }}">{{$prev2}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userPopular', ['page' => $prev]) }}">{{$prev}}</a></li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userPopular', ['page' => $next]) }}">{{$next}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userPopular', ['page' => $next2]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userPopular', ['page' => $next]) }}">Next</a>
      </li>
    </ul>
  </nav>
  @elseif($lastSegment > 1)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="{{ route('userPopular', ['page' => $prev]) }}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('userPopular', ['page' => $prev]) }}">{{$prev}}</a></li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userPopular', ['page' => $next]) }}">{{$next}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userPopular', ['page' => $next2]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userPopular', ['page' => $next]) }}">Next</a>
      </li>
    </ul>
  </nav>
@endif

@elseif($secondLastSegment=='anime-movies')
<div class="p-2"></div>
@if($lastSegment==1)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item disabled">
        <a class="page-link">Previous</a>
      </li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userMovie', ['page' => $next]) }}">{{ $next }}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userMovie', ['page' => $next2]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userMovie', ['page' => $next]) }}">Next</a>
      </li>
    </ul>
  </nav>
@elseif($lastSegment > 2)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="{{ route('userMovie', ['page' => $prev]) }}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('userMovie', ['page' => $prev2]) }}">{{$prev2}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userMovie', ['page' => $prev]) }}">{{$prev}}</a></li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userMovie', ['page' => $next]) }}">{{$next}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userMovie', ['page' => $next2]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userMovie', ['page' => $next]) }}">Next</a>
      </li>
    </ul>
  </nav>
  @elseif($lastSegment > 1)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="{{ route('userMovie', ['page' => $prev]) }}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('userMovie', ['page' => $prev]) }}">{{$prev}}</a></li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userMovie', ['page' => $next]) }}">{{$next}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userMovie', ['page' => $next2]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userMovie', ['page' => $next]) }}">Next</a>
      </li>
    </ul>
  </nav>

@endif

@elseif ($secondLastSegment=='top-airing')
<div class="p-2"></div>
@if($lastSegment==1)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item disabled">
        <a class="page-link">Previous</a>
      </li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userTopair', ['page' => $next]) }}">{{ $next }}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userTopair', ['page' => $next2]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userTopair', ['page' => $next]) }}">Next</a>
      </li>
    </ul>
  </nav>
@elseif($lastSegment > 2)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="{{ route('userTopair', ['page' => $prev]) }}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('userTopair', ['page' => $prev2]) }}">{{$prev2}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userTopair', ['page' => $prev]) }}">{{$prev}}</a></li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userTopair', ['page' => $next]) }}">{{$next}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userTopair', ['page' => $next2]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userTopair', ['page' => $next]) }}">Next</a>
      </li>
    </ul>
  </nav>
  @elseif($lastSegment > 1)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="{{ route('userTopair', ['page' => $prev]) }}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('userPopular', ['page' => $prev]) }}">{{$prev}}</a></li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userTopair', ['page' => $next]) }}">{{$next}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userTopair', ['page' => $next2]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userTopair', ['page' => $next]) }}">Next</a>
      </li>
    </ul>
  </nav>
@endif

@elseif($secondLastSegment=='recent-release')

<div class="p-2"></div>
@if($lastSegment==1)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item disabled">
        <a class="page-link">Previous</a>
      </li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userRecent', ['page' => $next]) }}">{{ $next }}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userRecent', ['page' => $next2]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userRecent', ['page' => $next]) }}">Next</a>
      </li>
    </ul>
  </nav>
@elseif($lastSegment > 2)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="{{ route('userRecent', ['page' => $prev]) }}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('userRecent', ['page' => $prev2]) }}">{{$prev2}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userRecent', ['page' => $prev]) }}">{{$prev}}</a></li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userRecent', ['page' => $next]) }}">{{$next}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userRecent', ['page' => $next2]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userRecent', ['page' => $next]) }}">Next</a>
      </li>
    </ul>
  </nav>
  @elseif($lastSegment > 1)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="{{ route('userRecent', ['page' => $prev]) }}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('userRecent', ['page' => $prev]) }}">{{$prev}}</a></li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userRecent', ['page' => $next]) }}">{{$next}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userRecent', ['page' => $next2]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userRecent', ['page' => $next]) }}">Next</a>
      </li>
    </ul>
  </nav>
@endif

<!--genre -->
@else

<div class="p-2"></div>
@if($lastSegment==1)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item disabled">
        <a class="page-link">Previous</a>
      </li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userGenre', ['page' => $next,'genre'=>$secondLastSegment]) }}">{{ $next }}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userGenre', ['page' => $next2,'genre'=>$secondLastSegment]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userGenre', ['page' => $next,'genre'=>$secondLastSegment]) }}">Next</a>
      </li>
    </ul>
  </nav>
@elseif($lastSegment > 2)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="{{ route('userGenre', ['page' => $prev,'genre'=>$secondLastSegment]) }}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('userGenre', ['page' => $prev2,'genre'=>$secondLastSegment]) }}">{{$prev2}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userGenre', ['page' => $prev,'genre'=>$secondLastSegment]) }}">{{$prev}}</a></li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userGenre', ['page' => $next,'genre'=>$secondLastSegment]) }}">{{$next}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userGenre', ['page' => $next2,'genre'=>$secondLastSegment]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userGenre', ['page' => $next,'genre'=>$secondLastSegment]) }}">Next</a>
      </li>
    </ul>
  </nav>
  @elseif($lastSegment > 1)
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item">
        <a class="page-link" href="{{ route('userGenre', ['page' => $prev,'genre'=>$secondLastSegment]) }}">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="{{ route('userGenre', ['page' => $prev,'genre'=>$secondLastSegment]) }}">{{$prev}}</a></li>
      <li class="page-item active"><a class="page-link" href="#">{{$lastSegment}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userGenre', ['page' => $next,'genre'=>$secondLastSegment]) }}">{{$next}}</a></li>
      <li class="page-item"><a class="page-link" href="{{ route('userGenre', ['page' => $next2,'genre'=>$secondLastSegment]) }}">{{$next2}}</a></li>
      <li class="page-item">
        <a class="page-link" href="{{ route('userGenre', ['page' => $next,'genre'=>$secondLastSegment]) }}">Next</a>
      </li>
    </ul>
  </nav>
  @endif

@endif