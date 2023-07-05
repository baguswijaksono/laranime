<!doctype html>
@if (Auth::check() && Auth::user()->theme === 'light')
    <html lang="en">
@else
    <html lang="en" data-bs-theme="dark">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Popular Anime Data Insert</title>
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
    set_time_limit(1200);

    $totalPages = isset($_GET['totalPages']) ? intval($_GET['totalPages']) : 0;
    $minPages = isset($_GET['minPages']) ? intval($_GET['minPages']) : 1;

    for ($page = $minPages; $page <= $totalPages; $page++) {
        $url = "https://gogoanime-api-production.up.railway.app/popular?page=$page";
        $data = file_get_contents($url);
        $data = json_decode($data, true);

        $i = 0;
        foreach ($data as $item) {
            $i++;
            $animeId = $item['animeId'];
            $details = "https://gogoanime-api-production.up.railway.app/anime-details/$animeId";

            $json = file_get_contents($details);
            $json = '[' . $json . ']';
            try {
    $data = json_decode($json, true); // Decode the JSON into an associative array

    // Assuming you have established a database connection and have a suitable model
    $popular = new EnDetails();

    // Access the first object in the array (assuming there's only one)
    $animeData = $data[0];

    // Assign the values from the JSON object to the model properties
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

    // Save the data to the database
    
    $popular->save();

    foreach ($animeData['episodesList'] as $episode) {
        $eps = new epsList();
        $eps -> animeId = $animeId;
        $eps -> episodeId = $episode['episodeId'];
        $eps -> episodeNum = $episode['episodeNum'];
    $eps->save();

}

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
            

            $percent = ($i / $totalPages) * (100/10)/2;
            echo "<script>
                document.getElementsByClassName('progress-bar')[0].style.width = '" . $percent . "%';
                document.getElementsByClassName('progress-bar')[0].setAttribute('aria-valuenow', '" . $percent . "');
                document.getElementsByClassName('progress-bar')[0].innerHTML = '" . $percent . "%';
                document.getElementsByClassName('logdata')[0].innerHTML = '$animeId Data inserted successfully ';

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
                            button1.href = 'http://localhost/eslolin/scraper/add_popular.php';

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
        }
    }
    @endphp

</body>

</html>
