@extends('master')
@section('content')
<body>
    <main>
    <div class="container mt-5">
            <h1 class="mb-4">Editar Millora</h1>
            <form class="row">
            <div class="col-md-6 Z mt-3">
                <div class="mb-3">
                    <label for="title" class="form-label">Títol</label>
                    <input type="text" class="form-control" id="title" placeholder="Modifica el títol">
                </div>
                <div class="mb-3">
                    <label for="zone" class="form-label">Zona</label>
                    <input type="number" class="form-control" id="zone" placeholder="Modifica la zona">
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">Estat</label>
                    <input type="text" class="form-control" id="state" placeholder="Modifica l'estat">
                </div>
            </div>
            <div class="col-md-6 Z mt-3">
                <div class="mb-3">
                    <label for="benefit" class="form-label">Benefici</label>
                    <input type="text" class="form-control" id="benefit" placeholder="Modifica el benefici">
                </div>
                <div class="mb-3">
                    <label for="worry" class="form-label">Preocupació</label>
                    <input type="text" class="form-control" id="worry" placeholder="Modifica la preocupació">
                </div>
                <div class="mb-3">
                    <label for="like" class="form-label">M'agrada</label>
                    <input type="number" class="form-control" id="like" placeholder="Modifica el m'agrada">
                </div>
            </div>
            <div class="col-md-6 Z mt-3">
                <div class="mb-3">
                <label for="type" class="form-label">Tipus</label>
                <select class="form-select" id="type">
                    <option value="Maquinaria">Maquinària</option>
                    <option value="Espacio">Espai</option>
                    <option value="Material">Material</option>
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
@endsection
