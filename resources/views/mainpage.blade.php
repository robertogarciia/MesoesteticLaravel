<!doctype html>
<html lang="en">
<head>
    <title>Editar Perfil - Mesoestetic</title>
    <!-- Metaetiquetes necessàries -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- CSS de Bootstrap v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Mesoestetic</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Inici</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Serveis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Productes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacte</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container mt-5">
            <h1 class="mb-4">Editar Perfil</h1>
            <form>
                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'usuari</label>
                    <input type="text" class="form-control" id="username" placeholder="Introduïu el vostre nom d'usuari">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correu electrònic</label>
                    <input type="email" class="form-control" id="email" placeholder="Introduïu el vostre correu electrònic">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contrasenya</label>
                    <input type="password" class="form-control" id="password" placeholder="Introduïu la vostra contrasenya">
                </div>
                <div class="mb-3">
                    <label for="dob" class="form-label">Data de naixement</label>
                    <input type="date" class="form-control" id="dob">
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">País</label>
                    <select class="form-select" id="country">
                        <option value="">Selecciona el teu país</option>
                        <option value="espanya">Espanya</option>
                        <option value="frança">França</option>
                        <option value="alemanya">Alemanya</option>
                        <!-- Afegir més opcions aquí -->
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Desar canvis</button>
            </form>
        </div>
    </main>
    <footer>
        <!-- peu de pàgina aquí -->
    </footer>
    <!-- Biblioteques JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
