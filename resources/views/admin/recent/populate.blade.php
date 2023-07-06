<!doctype html>
@if (Auth::check() && Auth::user()->theme === 'light')
    <html lang="en">
@else
    <html lang="en" data-bs-theme="dark">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>recent-release Anime Data Insert</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<style>
    .hidden {
        display: none;
    }
</style>

<body>
    <div class="container" style="max-width: 1000px; padding-top: 45vh;">
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                style="width: 0%;">
                0%
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row"></div>
    </div>

    <center>
        <div class='logdata'></div>
    </center>

    <div class="container">
        @php
            use App\Models\Recent;
            set_time_limit(43200);
            
            $totalPages = isset($_GET['totalPages']) ? intval($_GET['totalPages']) : 0;
            $minPages = isset($_GET['minPages']) ? intval($_GET['minPages']) : 1;
            
            if ($totalPages <= 0) {
            } else {
                for ($page = $minPages; $page <= $totalPages; $page++) {
                    $url = "https://gogoanime-api-production.up.railway.app/recent-release?page=$page";
            
                    $json = file_get_contents($url);
                    $array = json_decode($json, true);
            
                    foreach ($array as $key) {
                        $recent = new Recent();
                        $recent->page = $page;
                        $recent->episodeId = $key['episodeId'];
                        $recent->animeTitle = $key['animeTitle'];
                        $recent->episodeNum = $key['episodeNum'];
                        $recent->subOrDub = $key['subOrDub'];
                        $recent->animeImg = $key['animeImg'];
                        $recent->save();
                    }
            
                    $percent = ($page / $totalPages) * 100;
                    echo '<script>
                        document.getElementsByClassName('progress-bar')[0].style.width = '" . $percent . "%';
                        document.getElementsByClassName('progress-bar')[0].setAttribute('aria-valuenow', '" . $percent . "');
                        document.getElementsByClassName('progress-bar')[0].innerHTML = '" . $percent . "%';
                        document.getElementsByClassName('logdata')[0].innerHTML =
                            'recent-release Anime Data inserted successfully for recent-release page $page';

                        if (" . $percent . " === 100) {
                            var buttonsDiv = document.createElement('div');
                            buttonsDiv.classList.add('text-center', 'mt-3');

                            var button1 = document.createElement('a'); // Create an anchor element instead of a button
                            button1.classList.add('btn', 'btn-primary', 'me-2');
                            button1.innerHTML = 'Insert Again';
                            button1.href =
                            'http://localhost/eslolin/scraper/add_recent-release.php'; // Set the href attribute to the desired URL

                            var button2 = document.createElement('a'); // Create an anchor element instead of a button
                            button2.classList.add('btn', 'btn-secondary');
                            button2.innerHTML = 'Back to Dashboard';
                            button2.href = '/admin';

                            buttonsDiv.appendChild(button1);
                            buttonsDiv.appendChild(button2);

                            document.body.appendChild(buttonsDiv);
                        }
                    </script>';
            
                    flush();
                    ob_flush();
                    usleep(100000);
                }
            }
        @endphp
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <script>
        function setTotalPages() {
            var totalPagesInput = document.getElementById('totalPagesInput');
            var totalPages = parseInt(totalPagesInput.value);

            if (totalPages > 0) {
                // Redirect to the current page with the total pages value as a query parameter
                window.location.href = window.location.pathname + '?totalPages=' + totalPages;
            }
        }
    </script>
</body>

</html>
