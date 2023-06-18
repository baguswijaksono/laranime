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