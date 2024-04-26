@extends('master')
@section('content')

<style>
/* General container style */
.container {
    background-color: #f5f5f5;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 40px;
    max-width: 900px;
    margin: 5% auto;
}

/* Estilo para etiquetas */
label {
    font-weight: bold;
    color: #333;
    font-size: 18px;
}

/* Estilo para controles de formulario */
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

/* Estilo para el botón de envío */
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

/* Estilo para selector de colores */
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

/* Aumentar tamaño al pasar el cursor y agregar borde */
.color-option:hover {
    transform: scale(1.2);
    border: 2px solid #000000;
    /* Borde negro */
}

/* Colores de las opciones */
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

/* Ocultar input radio por defecto */
input[type="radio"] {
    display: none;
}

/* Estilo para opción seleccionada */
input[type="radio"]:checked + .color-option {
  border: 3px solid #000000; /* Borde negro para opción seleccionada */
}


/* Espacio entre filas */
.mb-3 {
    margin-bottom: 30px;
}

/* Alineación de texto */
.row {
    text-align: left;
}

/* Ajustar el ancho y el padding del select */
select.form-control {
    
    width: 100%;
}
</style>

<body>
    <div class="container">
        <form method="POST" action="{{ route('upgrades.update', ['upgrade' => $upgrade]) }}">
            @csrf
            @method('PUT')

            <div class="mb-3 row">
                <label para="title" class="col-sm-4">Título:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="title" id="title" value="{{ $upgrade->title }}"
                        placeholder="Título...">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-4">Zona:</label>
                <div class="col-sm-8">
                    <div class="color-selector">
                        <!-- Botones de radio con borde para opción seleccionada -->
                        <label class="color-label">
                            <input type="radio" id="zone_1" name="zone" value="Medicamentos"
                                {{ $upgrade->zone == 'Medicamentos' ? 'checked' : '' }}>
                            <div class="color-option rojo"></div>
                        </label>
                        <label class="color-label">
                            <input type="radio" id="zone_2" name="zone" value="Sanitaria"
                                {{ $upgrade->zone == 'Sanitaria' ? 'checked' : '' }}>
                            <div class="color-option verde"></div>
                        </label>
                        <label class="color-label">
                            <input type="radio" id="zone_3" name="zone" value="Cosmeticos"
                                {{ $upgrade->zone == 'Cosmeticos' ? 'checked' : '' }}>
                            <div class="color-option azul"></div>
                        </label>
                        <label class="color-label">
                            <input type="radio" id="zone_4" name="zone" value="Control de Calidad"
                                {{ $upgrade->zone == 'Control de Calidad' ? 'checked' : '' }}>
                            <div class="color-option gris"></div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <label para="type" class="col-sm-4">Tipo:</label>
                <div class="col-sm-8">
                    <select class="form-control" id="type" name="type">
                        <option value="Máquinaria" {{ $upgrade->type == 'Máquinaria' ? 'selected' : '' }}>Máquinaria
                        </option>
                        <option value="Espacio" {{ $upgrade->type == 'Espacio' ? 'selected' : '' }}>Espacio</option>
                        <option value="Material" {{ $upgrade->type == 'Material' ? 'selected' : '' }}>Material</option>
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label para="worry" class="col-sm-4">Preocupación:</label>
                <div class="col-sm-8">
                    <textarea class="form-control" name="worry" id="worry" rows="3">{{ $upgrade->worry }}</textarea>
                </div>
            </div>

            <div class="mb-3 row">
                <label para="benefit" class="col-sm-4">Beneficio:</label>
                <div class="col-sm-8">
                    <textarea class="form-control" name="benefit" id="benefit"
                        rows="3">{{ $upgrade->benefit }}</textarea>
                </div>
            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>

        </form>
    </div>
</body>
@endsection