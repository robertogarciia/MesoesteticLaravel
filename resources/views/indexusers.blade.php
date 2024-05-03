@extends('master')

@section('content')

<style>
    .row {
        margin-left: 4%;
        margin-right: 4%;
    }
    .card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
    }
    .table-mode {
        width: 100%;
        border-collapse: collapse; /* Para bordes en la tabla */
    }
    .table-mode th, .table-mode td {
        padding: 12px;
        text-align: left;
    }
    .table-mode th {
        background-color: #f2f2f2; /* Fondo para encabezados */
        border-bottom: 2px solid #ddd; /* Borde inferior */
    }
    .table-mode tr:nth-child(odd) {
        background-color: #f9f9f9; /* Fondo alternado para filas */
    }
</style>

<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center my-4">
    <h2 style="margin-left: 5%;">Lista de Usuarios</h2>
    <div>
      <!-- Botón para cambiar de modo -->
      <a href="{{ url()->current() }}?mode={{ $mode == 'cards' ? 'table' : 'cards' }}" 
         class="btn btn-info ms-4 btn-lg" 
         style="margin-right: 20px;">
         {{ $mode == 'cards' ? 'Cambiar a Tabla' : 'Cambiar a Cartas' }}
      </a>
      <a href="{{ route('users.create') }}" 
         class="btn btn-success ms-4 btn-lg" 
         style="margin-right: 20px;">Crear Usuario
      </a>
    </div>
  </div>
  
  @if($mode == 'cards')
  <!-- Modo Cartas -->
  <div class="row">
    @foreach($users as $usuario)
    <div class="col-lg-4 col-md-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title mb-3">{{ $usuario->email }}</h5>
          <p class="card-text mb-2">Cargo: {{ $usuario->post ? 'Admin' : 'Usuario' }}</p>
          <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('users.edit', $usuario->id) }}" 
               class="btn btn-primary btn-sm mr-2">
               <i class="fa fa-edit"></i> Editar
            </a>
            <form action="{{ route('users.destroy', $usuario->id) }}" 
                  method="POST" 
                  class="delete-form">
              @csrf
              @method('DELETE')
              <button type="submit" 
                      class="btn btn-danger btn-sm" 
                      onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">
                      <i class="fa fa-trash"></i> Eliminar
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  @else
  <!-- Modo Tabla -->
  <table class="table-mode">
    <thead>
      <tr>
        <th>Correo Electrónico</th>
        <th>Cargo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach($users as $usuario)
      <tr>
        <td>{{ $usuario->email }}</td>
        <td>{{ $usuario->post ? 'Admin' : 'Usuario' }}</td>
        <td>
          <a href="{{ route('users.edit', $usuario->id) }}" 
             class="btn btn-primary btn-sm">
             <i class="fa fa-edit"></i> Editar
          </a>
          <form action="{{ route('users.destroy', $usuario->id) }}" 
                method="POST" 
                class="delete-form" 
                style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="btn btn-danger btn-sm" 
                    onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">
                    <i class="fa fa-trash"></i> Eliminar
            </button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif

</div>

@endsection
