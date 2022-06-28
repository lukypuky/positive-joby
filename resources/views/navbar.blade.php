<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <script src='/js/script.js' type="text/javascript"></script>
    <title>PositiveJoby</title>
</head>

<body>
    <div class="header">
        <nav class="navbar navbar-expand-sm navbar-light">
            <div class="container-fluid ">
                <a class="navbar-brand" href="#">
                    <img src="/img/logo.positive.png" alt="" width="150" height="30">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#"><strong>Joby</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#"><strong>Referencie</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#"><strong>Kontakt</strong></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="/img/logo.positive.png" alt="" width="150" height="30">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="justify-content-end;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Joby</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Referencie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Kontakt</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> --}}
    </div>
    <div class="content">
        @yield('index')
    </div>
    <div class="footer"></div>
</body>

</html>
