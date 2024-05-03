@extends('master')

@section('content')

<style>
    .table {
        border-radius: 20px; /* Bordes redondeados para la tabla */
        overflow: hidden; /* Asegura que los bordes redondeados se apliquen correctamente */
        font-size: 1.2em; /* Tamaño de letra más grande */
    }
    .table th, .table td {
        padding: 12px; /* Espaciado para celdas */
        text-align: left; /* Alineación de texto */
        border-bottom: 1px solid #ddd; /* Borde inferior para filas */
    }
    .table thead {
        background-color: #f2f2f2; /* Fondo para encabezados */
        font-weight: bold; /* Negrita para encabezados */
    }
</style>

<div class="container-fluid"> <!-- Contenedor más amplio -->
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1>Lista de Usuarios</h1>
        <a href="{{ route('users.create') }}" 
           class="btn btn-success btn-lg" 
           style="margin-right: 20px;">Crear Usuario
        </a>
    </div>

    <div class="table-responsive"> <!-- Para adaptarse a diferentes tamaños de pantalla -->
        <table class="table"> <!-- Tabla con bordes redondeados -->
            <thead class="bg-light"> <!-- Encabezados destacados -->
                <tr>
                    <th>ID</th>
                    <th>Correo</th>
                    <th>Cargo</th>
                    <th>Acciones</th> <!-- Columna para acciones -->
                </tr>
            </thead>
            <tbody>
                @foreach($users as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td> <!-- ID del usuario -->
                    <td>{{ $usuario->email }}</td> <!-- Correo del usuario -->
                    <td>
                        @if($usuario->post == 1)
                            Admin
                        @else
                            Usuario
                        @endif
                    </td>
                    <td> <!-- Acciones para cada usuario -->
                        <a href="{{ route('users.edit', $usuario->id) }}" 
                           class="btn btn-primary btn-lg" 
                           style="margin-right: 5px;">
                           Editar
                        </a>
                        <form action="{{ route('users.destroy', $usuario->id) }}" 
                              method="POST" 
                              style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger btn-lg" 
                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">
                                    Borrar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
