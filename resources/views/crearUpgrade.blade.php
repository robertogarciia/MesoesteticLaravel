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
    <!--<form method='POST' action="{{ url('------') }}"> @csrf -->
    <form>
        <div class="mb-3 row">
            <label for="inputName" class="col-4 col-form-label">Titulo:</label>
                <div class="col-6">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Título...">
                </div>


            <label>Zona:</label><br>
            <div class="col-6">
                <label for="rojo" class="circulo rojo">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                </label>
                <label for="verde" class="circulo verde">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                </label>
                <label for="azul" class="circulo azul">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                </label>
                <label for="amarillo" class="circulo amarillo">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                </label>
              </div>

              <label for="type" class="col-4 col-form-label">Tipo:</label>
              <div class="col-6">
                <select class="form-control" id="exampleFormControlSelect1">
                <option>Máquinaria</option>
                <option>Espacios</option>
                <option>Utensilios</option>
                </select>
              </div>

                <label for="worry">Prepcupación:</label>
              <div class="col-6">
                  <textarea class="form-control" id="worry" rows="3"></textarea>
              </div>

              <label for="benefit">Beneficio:</label>
              <div class="col-6">
                  <textarea class="form-control" id="benefit" rows="3"></textarea>
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