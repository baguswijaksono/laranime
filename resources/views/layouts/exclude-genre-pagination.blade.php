<nav aria-label="..." style="padding-top: 30px; padding-left: 15px;">
  <ul class="pagination">
    @if ($acpg == 1)
    <li class="page-item disabled">
      <span class="page-link">Previous</span>
    </li>
    @else
    <li class="page-item">
      <a class="page-link" href="{{ url('/en/' . $acgn . '/' . $prevPage) }}">Previous</a>
    </li>
    @endif

    @if ($acpg > 2)
    <li class="page-item">
      <a class="page-link" href="{{ url('/en/' . $acgn . '/' . ($acpg-1)) }}">{{ $acpg-1 }}</a>
    </li>
    @endif

    <li class="page-item {{ $acpg == $acpg ? 'active' : '' }}" aria-current="page">
      <a class="page-link" href="{{ url('/en/' . $acgn . '/' . $acpg) }}">{{ $acpg }}</a>
    </li>

    @if ($acpg < $totalPage)
    <li class="page-item">
      <a class="page-link" href="{{ url('/en/' . $acgn . '/' . ($acpg+1)) }}">{{ $acpg+1 }}</a>
    </li>
    @endif

    @if ($acpg == $totalPage)
    <li class="page-item disabled">
      <span class="page-link">Next</span>
    </li>
    @else
    
    <li class="page-item">
      <a class="page-link" href="{{ url('/en/' . $acgn . '/' . $nextPage) }}">Next</a>
    </li>
    @endif
  </ul>
</nav>
