<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://kit.fontawesome.com/dcd17d192d.js" crossorigin="anonymous"></script>
    {{-- zakomentovane kvoli posielaniu mailov --}}
    {{-- <script src="https://www.google.com/recaptcha/api.js"></script> --}}
    <script src='/js/script.js' type="text/javascript"></script>
    <title>Positive-joby</title>
    <meta property="og:title" content=Positive-joby>
    <meta property="og:site_name" content=Positive-joby>
    <meta property="og:url" content=http://joby.positive.sk>
    <meta property="og:description" content=positive-joby>
    <meta property="og:type" content=website>
    <meta property="og:image" content=https://positive.sk//storage/settings/December2020/TyWT88fVu1pX0P4iMa4e.png>
</head>

<body>
    <div class="header">
        <nav class="navbar navbar-expand-sm navbar-light pageNavbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('getIndex') }}">
                    <img src="/img/logo.positive.png" alt="Positive s.r.o. logo" class="positiveLogo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            @if (Route::currentRouteNamed('getIndex') || Route::currentRouteNamed('getJob'))
                                <a class="active" aria-current="page"
                                    href="{{ route('getIndex') }}"><strong>Joby</strong></a>
                            @else
                                <a class="" aria-current="page"
                                    href="{{ route('getIndex') }}"><strong>Joby</strong></a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="{{ Route::currentRouteNamed('getReference') ? 'active' : '' }}"
                                aria-current="page" href="{{ route('getReference') }}"><strong>Referencie</strong></a>
                        </li>
                        <li class="nav-item">
                            <a class="{{ Route::currentRouteNamed('getContact') ? 'active' : '' }}" aria-current="page"
                                href="{{ route('getContact') }}"><strong>Kontakt</strong></a>
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
        @yield('errorModal')
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

    <footer class="text-center pageFooter">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <section>
                <a href="{{ route('getIndex') }}" role="button" class="footerButton">Joby</a>
                <a href="{{ route('getReference') }}" role="button" class="footerButton">Referencie</a>
                <a href="{{ route('getContact') }}" role="button" class="footerButton">Kontakt</a>
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
