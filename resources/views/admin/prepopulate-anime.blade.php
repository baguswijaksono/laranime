<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
  <center>
    <form role="input" id="input-form" style="max-width: 1000px; padding-top: 45vh;">
      <input style="max-width: 450px" class="form-control" type="number" placeholder="Enter how many pages you want to start" aria-label="input" id="inputan" required min="1">
      <input style="max-width: 450px" class="form-control" type="number" placeholder="Enter how many pages you want to insert" aria-label="input" id="inputan2" required min="1">
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </center>

  <script>
    document.querySelector('#input-form').addEventListener('submit', function(e) {
      e.preventDefault();
      var inputan = document.querySelector('#inputan').value;
      var inputan2 = document.querySelector('#inputan2').value;
      var url = window.location.origin + '/populate-anime?totalPages=' + inputan + '&minPages=' + inputan2;
      window.location.href = url;
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
