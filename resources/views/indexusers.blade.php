@extends('master')

@section('content')

<style>
    .row{
        margin-left:4%;
        margin-right:4%;
    }
</style>

<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center my-4">
    <h2 style="margin-left:5%;">Llista d'usuaris</h2>
    <a href="{{ route('users.create') }}" class="btn btn-success ms-4 btn-lg" style="margin-right:20px;">Crear Usuari</a>
  </div>
  <div class="row">
    @foreach($users as $usuario)
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card shadow">
        <div class="card-body">
          <h5 class="card-title mb-3">{{ $usuario->email }}</h5>
          <p class="card-text mb-2">Cargo: {{ $usuario->post ? 'Admin' : 'Usuario' }}</p>
          <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('users.edit', $usuario->id) }}" class="btn btn-primary btn-sm mr-2">Editar</a>
            <form action="{{ route('users.destroy', $usuario->id) }}" method="POST" class="delete-form">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">Eliminar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endsection