<!doctype html>
@if (Auth::check() && Auth::user()->theme === 'light')
    <html lang="en">
@else
    <html lang="en" data-bs-theme="dark">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pre Populate Popular</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    @include('layouts.admin-navbar')
    <div class="d-flex align-items-center justify-content-center" style="min-height: 85vh;">
        <div class="container-sm" style="max-width:650px">
            <form role="input" id="input-form">
                <div class="mb-3">
                    <label for="inputan" class="form-label">Start Index page for Crawling</label>
                    <input class="form-control" type="number" placeholder="Enter pages you want to start crawling"
                        aria-label="input" id="inputan2" required min="1">
                </div>
                <div class="mb-3">

                    <label for="exampleFormControlInput1" class="form-label">Maximum Index page for Crawling</label>
                    <input class="form-control" type="number"
                        placeholder="Enter maximum pages you want to crawling stop" aria-label="input" id="inputan"
                        required min="1">
                </div>
                @if (Auth::check() && Auth::user()->theme === 'light')
                    <button type="submit" class="btn btn-dark">Submit</button>
                @else
                    <button type="submit" class="btn btn-primary">Submit</button>
                @endif

            </form>
        </div>
    </div>


    <script>
        document.querySelector('#input-form').addEventListener('submit', function(e) {
            e.preventDefault();
            var inputan = document.querySelector('#inputan').value;
            var inputan2 = document.querySelector('#inputan2').value;
            var url = window.location.origin + '/populate-popular?totalPages=' + inputan + '&minPages=' + inputan2;
            window.location.href = url;
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>
