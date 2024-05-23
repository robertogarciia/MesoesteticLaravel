@extends('master')
@section('content')
<style>
  /* Estil del contenidor general */
  .container {
    background-color: #f5f5f5;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 40px;
    max-width: 900px;
    margin: 5% auto;
  }

  /* Estil per a etiquetes */
  label {
    font-weight: bold;
    color: #333;
    font-size: 18px;
  }

  /* Estil per a controls de formulari */
  .form-control {
    border-radius: 8px; 
    border: 2px solid #ccc; 
    
    font-size: 16px;
    transition: all 0.3s;
  }

  .form-control:focus {
    border-color: #3498db;
    box-shadow: 0 0 15px rgba(52, 152, 219, 0.3);
  }

  /* Estil per al botó d'enviament */
  .btn-primary {
    background-color: #3498db;
    border-color: #3498db;
    color: white;
    padding: 14px 30px;
    font-size: 16px;
    border-radius: 8px;
    transition: all 0.3s;
  }

  
  .btn-primary:hover {
    background-color: #2980b9;
  }

  /* Estil per al selector de colors */
  .color-selector {
    display: flex;
    gap: 20px;
    align-items: center; 
  }

  .color-option {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer; 
    transition: transform 0.3s, border 0.3s;
  }

  /* Augmentar la mida en passar el cursor i afegir vora */
  .color-option:hover {
    transform: scale(1.2);
    border: 3px solid #000000; /* Vora negra 2px */
  }

  /* Colors de les opcions */
  .rojo {
    background-color: #FF3636; 
  }

  .verde {
    background-color: #52F43E; 
  }

  .azul {
    background-color: #557EF3; 
  }

  .gris {
    background-color: #C1C1C1; 
  }

  /* Ocultar input radio per defecte */
  input[type="radio"] {
    display: none;
  }

  /* Estil per a l'opció seleccionada */
  input[type="radio"]:checked + .color-option {
    border: 3px solid #000000; /* Vora negra de 2px */
  }

  /* Espai entre files */
  .mb-3 {
    margin-bottom: 30px; 
  }

  /* Alineació de text */
  .row {
    text-align: left;
  }

  /* Ajustar l'amplada i el padding del select */
  select.form-control {
    
    width: 100%; 
  }
</style>

<body>
  <div class="container">
    <form method="POST" action="{{ route('upgrades.store') }}">
      @csrf

      <div class="mb-3 row">
        <label para="inputName" class="col-sm-4">Títol:</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" name="title" id="title" placeholder="Títol...">
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-4">Zona:</label>
        <div class="col-sm-8">
          <div class="color-selector">
            <!-- Botons de radio amb vora negra per a l'opció seleccionada -->
            <label class="color-label" title="Medicaments">
              <input type="radio" id="zone" name="zone" value="Medicaments">
              <div class="color-option rojo"></div>
            </label>
            <label class="color-label" title="Sanitària">
              <input type="radio" id="zone" name="zone" value="Sanitària">
              <div class="color-option verde"></div>
            </label>
            <label la
            bel="color-label" title="Cosmètics">
              <input type="radio" id="zone" name="zone" value="Cosmètics">
              <div class="color-option azul"></div>
            </label>
            <label class="color-label" title="Control de Qualitat">
              <input type="radio" id="zone" name="zone" value="Control de Qualitat">
              <div class="color-option gris"></div>
            </label>
          </div>
        </div>
      </div>

      <div class="mb-3 row">
        <label para="type" class="col-sm-4">Tipus:</label>
        <div class="col-sm-8">
          <select class="form-control" id="type" name="type">
            <option>Maquinària</option>
            <option>Espai</option>
            <option>Material</option>
          </select>
        </div>
      </div>

      <div class="mb-3 row">
        <label para="worry" class="col-sm-4">Preocupació:</label>
        <div class="col-sm-8">
          <textarea class="form-control" name="worry" id="worry" rows="3" placeholder="Descriu les teves preocupacions..."></textarea>
        </div>
      </div>

      <div class="mb-3 row">
        <label para="benefit" class="col-sm-4">Benefici:</label>
        <div class="col-sm-8">
          <textarea class="form-control" name="benefit" id="benefit" rows="3" placeholder="Descriu els beneficis..."></textarea>
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
