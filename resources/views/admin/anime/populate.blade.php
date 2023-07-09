<!doctype html>
@if (Auth::check() && Auth::user()->theme === 'light')
    <html lang="en">
@else
    <html lang="en" data-bs-theme="dark">
@endif
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Populate Anime Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="max-width: 1000px; padding-top: 45vh;">
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                style="width: 0%;">
                0%
            </div>
        </div>
    </div>
    <center>
        <div class='logdata'>
        </div>
    </center>

    @php
    use App\Models\EnDetails;
    use App\Models\epsList;
    set_time_limit(1200000);

    $totalPages = isset($_GET['totalPages']) ? intval($_GET['totalPages']) : 0;
    $minPages = isset($_GET['minPages']) ? intval($_GET['minPages']) : 1;

    $itemsPerPage = 20; // Number of items per page
    $totalItems = ($totalPages - $minPages) * $itemsPerPage; // Total number of items to process
    $processedItems = 0; // Counter for processed items

    for ($page = $minPages; $page <= $totalPages; $page++) {
        $url = "https://gogoanime-api-production.up.railway.app/popular?page=$page";
        $data = file_get_contents($url);
        $data = json_decode($data, true);

        foreach ($data as $item) {
            $animeId = $item['animeId'];
            $details = "https://gogoanime-api-production.up.railway.app/anime-details/$animeId";

            $json = file_get_contents($details);
            $json = '[' . $json . ']';
            try {
                $data = json_decode($json, true);
                $animeData = $data[0];

                $popular = new EnDetails();
                $popular->animeId = $animeId;
                $popular->animeTitle = $animeData['animeTitle'];
                $popular->type = $animeData['type'];
                $popular->releasedDate = $animeData['releasedDate'];
                $popular->status = $animeData['status'];
                $popular->genres = json_encode($animeData['genres']);
                $popular->otherNames = $animeData['otherNames'];
                $popular->synopsis = $animeData['synopsis'];
                $popular->animeImg = $animeData['animeImg'];
                $popular->totalEpisodes = $animeData['totalEpisodes'];
                $popular->save();

                foreach ($animeData['episodesList'] as $episode) {
                    $eps = new epsList();
                    $eps->animeId = $animeId;
                    $eps->episodeId = $episode['episodeId'];
                    $eps->episodeNum = $episode['episodeNum'];
                    $eps->embedUrl = "https://player.anikatsu.me/?id=" . $episode['episodeId'];
                    $eps->save();
                }

                $processedItems++;
                $percent = ($processedItems / $totalItems) * 50;

                echo "<script>
                    document.getElementsByClassName('progress-bar')[0].style.width = '" . $percent . "%';
                    document.getElementsByClassName('progress-bar')[0].setAttribute('aria-valuenow', '" . $percent . "');
                    document.getElementsByClassName('progress-bar')[0].innerHTML = '" . round($percent) . "%';
                    document.getElementsByClassName('logdata')[0].innerHTML = '".$animeData['animeTitle']." Data inserted successfully ';

                    if (" . $percent . " === 100) {
                        window.onload = function() {
                            var buttonsDiv = document.getElementById('customButtons');
                            if (!buttonsDiv) {
                                buttonsDiv = document.createElement('div');
                                buttonsDiv.classList.add('text-center', 'mt-3');
                                buttonsDiv.id = 'customButtons';

                                var button1 = document.createElement('a');
                                button1.classList.add('btn', 'btn-primary', 'me-2');
                                button1.innerHTML = 'Insert Again';
                                button1.href = '/pre-populate-anime';

                                var button2 = document.createElement('a');
                                button2.classList.add('btn', 'btn-secondary');
                                button2.innerHTML = 'Back to Dashboard';
                                button2.href = 'your_dashboard_url';

                                buttonsDiv.appendChild(button1);
                                buttonsDiv.appendChild(button2);

                                document.body.appendChild(buttonsDiv);
                            }
                        };
                    }
                </script>";
                flush();
                ob_flush();
                usleep(100000);
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
@endphp
</body>

</html>
