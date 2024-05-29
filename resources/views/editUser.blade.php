@extends('master')
@section('content')

<style>
/* Estil per al contenidor general */
.container {
    background-color: #f5f5f5;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    padding: 40px;
    max-width: 900px;
    margin: 5% auto;
}

/* Estil per a les etiquetes */
label {
    font-weight: bold;
    color: #333;
    font-size: 18px;
}

/* Estil per als controls del formulari */
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

/* Espai entre files */
.mb-3 {
    margin-bottom: 30px;
}

/* Alineació del text */
.row {
    text-align: left;
}

/* Ajust del width dels inputs */
select.form-control {
    width: 100%;
}
</style>

<div class="container">
    <form method="POST" action="{{ route('users.update', ['user' => $user]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3 row">
            <label for="title" class="col-sm-4">Correu electrònic:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
            </div>
        </div>

        <div class="mb-3 row">
            <div class="offset-sm-4 col-sm-8">
                <button type="submit" class="btn btn-primary">Guardar canvis</button>
            </div>
        </div>

    </form>
</div>

@endsection
