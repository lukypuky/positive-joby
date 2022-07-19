<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    {{-- zakomentovane kvoli posielaniu mailov --}}
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src='/js/script.js' type="text/javascript"></script>
    <title>PositiveJoby</title>
</head>

<body>
    <div class="header">
        <nav class="navbar navbar-expand-sm navbar-light" style="padding: 25px;">
            <div class="container-fluid">
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
                            <a class="nav-link {{ Route::currentRouteNamed('getIndex') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('getIndex') }}"><strong>Joby</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('getReference') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('getReference') }}"><strong>Referencie</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('getContact') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('getContact') }}"><strong>Kontakt</strong></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="content">
        @yield('index')
        @yield('contact')
        @yield('reference')
        @yield('job')
    </div>

    @if (session()->has('failEmail'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="flash_message">
            <span>{{ session('failEmail') }}</span>
        </div>
    @elseif(session()->has('successEmail'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="flash_message">
            <span>{{ session('successEmail') }}</span>
        </div>
    @elseif(session()->has('successJobEmail'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="flash_message">
            <span>{{ session('successJobEmail') }}</span>
        </div>
    @endif

    <footer class="text-center" style="background-color: #f5f4f2; color: #9f9f9e;">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <section>
                <a href="{{ route('getIndex') }}" role="button" style="color: #868686; padding: 0px 15px;">Joby</a>
                <a href="{{ route('getReference') }}" role="button"
                    style="color: #868686; padding: 0px 15px;">Referencie</a>
                <a href="{{ route('getContact') }}" role="button"
                    style="color: #868686; padding: 0px 15px;">Kontakt</a>
            </section>
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3">
            © created and designed by Positive, 2007 - 2022
        </div>
        <!-- Copyright -->
    </footer>
</body>

</html>
