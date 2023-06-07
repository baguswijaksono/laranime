<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Anime
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Popular Anime</a></li>
            <li><a class="dropdown-item" href="#">Recent Release</a></li>
            <li><a class="dropdown-item" href="#">Anime Movies</a></li>
            <li><a class="dropdown-item" href="#">Top Airing</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Genre
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">action</a></li>
            <li><a class="dropdown-item" href="#">adventure</a></li>
            <li><a class="dropdown-item" href="#">cars</a></li>
            <li><a class="dropdown-item" href="#">comedy</a></li>
            <li><a class="dropdown-item" href="#">crime</a></li>
            <li><a class="dropdown-item" href="#">dementia</a></li>
            <li><a class="dropdown-item" href="#">demons</a></li>
            <li><a class="dropdown-item" href="#">drama</a></li>
            <li><a class="dropdown-item" href="#">dub</a></li>
            <li><a class="dropdown-item" href="#">family</a></li>
            <li><a class="dropdown-item" href="#">fantasy</a></li>
            <li><a class="dropdown-item" href="#">game</a></li>
          </ul>
        </li>

      </ul>

      <form class="d-flex" role="search" id="search-form">
        <input class="form-control me-2" type="text" placeholder="Search" aria-label="Search" id="inputan">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
<script>
    document.querySelector('#search-form').addEventListener('submit', function(e) {
        e.preventDefault();
        var inputan = document.querySelector('#inputan').value;
        var url = window.location.origin + '/admin/search/' + inputan;
        window.location.href = url;
    });
</script>
    </div>
  </div>
</nav>