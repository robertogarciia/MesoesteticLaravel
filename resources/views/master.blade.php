<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesoestetic</title>
    <!-- Agrega los enlaces a los archivos CSS y JS necesarios si los estás utilizando -->
    <!-- Por ejemplo, para Bootstrap, añade algo como esto -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="{{ asset('images/mesoestetic-logo.png') }}" alt="logo mesoestetic"
            style="width:200px;padding-right:10px;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                @auth
                @if(strpos(Auth::user()->post, 1) !== false)
                <a class="nav-item nav-link {{ Request::is('home') ? 'font-weight-bold' : '' }}" href="/home">Home</a>

                @endif
                @endauth
                <a class="nav-item nav-link {{ Request::is('upgrades*') ? 'font-weight-bold' : '' }}"
                    href="{{ route('upgrades.index') }}">Upgrades</a>
                @auth
                @if(strpos(Auth::user()->post, 1) !== false)
                <a class="nav-item nav-link {{ Request::is('users*') ? 'font-weight-bold' : '' }}"
                    href="{{ route('users.index') }}">Users</a>
                @endif
                @endauth
            </div>
            <div style="margin-left:900px;">
                <img src="{{ asset('../images/LogoTiltedTowers.png') }}" alt="Tilted Towers" style="max-height: 60px;">
            </div>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link text-white">
                            <img src="{{ asset('images/FavIconLogOut.png') }}" alt="Log Out" style="max-height: 35px;">
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    @yield('content')
</body>

</html>