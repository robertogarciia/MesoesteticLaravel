<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <!-- Agrega los enlaces a los archivos CSS y JS necesarios si los estás utilizando -->
    <!-- Por ejemplo, para Bootstrap, añade algo como esto -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <img src="{{ asset('images/mesoestetic-logo.png') }}" alt="logo mesoestetic" style="width:200px;padding-right:10px;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="{{ route('upgrades.index') }}">Upgrades</a>
                <a class="nav-item nav-link" href="{{ route('users.index') }}">Users</a>

            </div>
            <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link text-white">
                                <img src="{{ asset('images/logOut.png') }}" alt="Log Out"
                                    style="max-height: 35px;">
                            </button>
                        </form>
                    </li>
                </ul>
        </div>
    </nav>

    @yield('content')
</body>

</html>