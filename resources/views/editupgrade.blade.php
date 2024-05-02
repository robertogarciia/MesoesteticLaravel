@extends('master')
@section('content')

<style>
    .circulo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: inline-block;
    }
    .circulo.rojo {
        background-color: #ff6b6b;
    }
    .circulo.verde {
        background-color: #6bff6b;
    }
    .circulo.azul {
        background-color: #6b9cff;
    }
    .circulo.amarillo {
        background-color: #ffea6b;
    }
   
    </style>

<body>
    <main>
    <div class="container mt-5">
            <form class="row" method='POST' action="{{ route('upgrades.update', ['upgrade'=>$upgrade]) }}">
            @csrf
            @method('PUT')
            <div class="col-md-6 Z mt-3">
            <input type="hidden" name="upgrade_id" value="{{ $upgrade->id }}">

                <div class="mb-3">
                    <label for="title" class="form-label">Títol</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Modifica el títol" value="{{ $upgrade->title }}">
                </div>
                <div class="mb-3">
                    <label class="col-4 col-form-label">Zona:</label><br>
                    <div class="col-6">
                        <label for="rojo" class="circulo rojo">
                            <input type="radio" class="form-check-input" id="zone" name="zone" value="Medicamentos" {{ $upgrade->zone == 'Medicamentos' ? 'checked' : '' }}>
                        </label>
                        <label for="verde" class="circulo verde">
                            <input type="radio" class="form-check-input" id="zone" name="zone" value="Sanitaria" {{ $upgrade->zone == 'Sanitaria' ? 'checked' : '' }}>
                        </label>
                        <label for="azul" class="circulo azul">
                            <input type="radio" class="form-check-input" id="zone" name="zone" value="Cosmeticos" {{ $upgrade->zone == 'Cosmeticos' ? 'checked' : '' }}>
                        </label> 
                        <label for="amarillo" class="circulo amarillo">
                            <input type="radio" class="form-check-input" id="zone" name="zone" value="Control de calidad" {{ $upgrade->zone == 'Control de calidad' ? 'checked' : '' }}>
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Tipo:</label>
                    <select class="form-control" id="type" name="type">
                        <option value="Máquinaria" {{ $upgrade->type == 'Máquinaria' ? 'selected' : '' }}>Máquinaria</option>
                        <option value="Espacio" {{ $upgrade->type == 'Espacio' ? 'selected' : '' }}>Espacio</option>
                        <option value="Material" {{ $upgrade->type == 'Material' ? 'selected' : '' }}>Material</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 Z mt-3">
                <div class="mb-3">
                    <label for="worry" class="form-label">Preocupació</label>
                    <textarea class="form-control" class="form-control" name="worry" id="worry"  rows="3" >{{ $upgrade->worry }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="benefit" class="form-label">Benefici</label>
                    <textarea class="form-control" class="form-control" name="benefit" id="benefit"  rows="3">{{ $upgrade->benefit }}</textarea>
                </div>
               
                
            </div>
            <div class="col-md-6 Z mt-3">
                
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
