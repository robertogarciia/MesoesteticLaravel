@extends('master')
@section('content')
    <style>
    .recuadro {
        background-color: #F5F5F5;
        padding: 10px;
        margin: 5% auto; 
        width: 700px;
        border-radius: 10px;
    }
    .circulo {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 10px;
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
    .mb-3.row > div {
        margin-bottom: 20px;
    }
   
    </style>

</head>
<body>
<div class="recuadro">

    <form method='POST' action="{{ route('upgrades.store') }}">
    @csrf
        <div class="mb-3 row">
            <label for="inputName" class="col-4 col-form-label">Titulo:</label>
                <div class="col-6">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Título...">
                </div>

                <label class="col-4 col-form-label">Zona:</label><br>
                <div class="col-6">
                    <label for="rojo" class="circulo rojo">
                        <input type="radio" class="form-check-input" id="zone" name="zone" value="Medicamentos">
                    </label>
                    <label for="verde" class="circulo verde">
                        <input type="radio" class="form-check-input" id="zone" name="zone" value="Sanitaria">
                    </label>
                    <label for="azul" class="circulo azul">
                        <input type="radio" class="form-check-input" id="zone" name="zone" value="Cosmeticos">
                    </label>
                    <label for="amarillo" class="circulo amarillo">
                        <input type="radio" class="form-check-input" id="zone" name="zone" value="Control de calidad ">
                    </label>
                </div>

              <label for="type" class="col-4 col-form-label">Tipo:</label>
              <div class="col-6">
                <select class="form-control" id="type" name="type">
                <option>Máquinaria</option>
                <option>Espacio</option>
                <option>Material</option>
                </select>
              </div>

             <label for="worry" class="col-4 col-form-label">Prepcupación:</label>
              <div class="col-6">
                  <textarea class="form-control" class="form-control" name="worry" id="worry"  rows="3"></textarea>
              </div>

              <label for="benefit" class="col-4 col-form-label">Beneficio:</label>
              <div class="col-6">
                  <textarea class="form-control" class="form-control" name="benefit" id="benefit"  rows="3"></textarea>
              </div>
        </div>

        <div class="mb-3 row">
            <div class="offset-sm-4 col-sm-8">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
        </div>
    </form>
</div>
</body>
@endsection