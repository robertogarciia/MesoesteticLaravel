@extends('master')

@section('content')

<style>
.table {
    border-radius: 20px;
    /* Cantonades arrodonides per a la taula */
    overflow: hidden;
    /* Assegura que les cantonades arrodonides s'apliquin correctament */
    font-size: 1.2em;
    /* Mida de lletra més gran */
}

.table th,
.table td {
    padding: 12px;
    /* Espaiat per a les cel·les */
    text-align: left;
    /* Alineació de text */
    border-bottom: 1px solid #ddd;
    /* Vora inferior per a files */
}

.table thead {
    background-color: #f2f2f2;
    /* Fons per als encapçalaments */
    font-weight: bold;
    /* Negreta per als encapçalaments */
}
</style>

<div class="container-fluid">
    <!-- Contenidor més ampli -->
    <div class="d-flex justify-content-between align-items-center my-4">

        <h1>Lista de Usuarios</h1>
        <form action="{{ route('users.index') }}" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search Products" value="{{ request('search') }}" class="search-input">
            <button type="submit" class="search-button">Search</button>
        </form>
        <a href="{{ route('users.create') }}" class="btn btn-success btn-lg" style="margin-right: 20px;">Crear Usuario</a>
    </div>

    <!-- Formulario de filtrado y ordenado -->
    <form method="GET" action="{{ route('users.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label for="post" class="form-label">Filtrar por tipo de usuario:</label>
                <select name="post" id="post" class="form-control">
                    <option value="">Todos</option>
                    <option value="1" {{ request('post') == '1' ? 'selected' : '' }}>Admin</option>
                    <option value="2" {{ request('post') == '2' ? 'selected' : '' }}>Usuario</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="sort_order" class="form-label">Ordenar por nombre:</label>
                <select name="sort_order" id="sort_order" class="form-control">
                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascendente</option>
                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descendente</option>
                </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-primary btn-lg">Aplicar</button>
            </div>
        </div>
    </form>

    <div class="table-responsive"> <!-- Para adaptarse a diferentes tamaños de pantalla -->
        <table class="table"> <!-- Tabla con bordes redondeados -->
            <thead class="bg-light"> <!-- Encabezados destacados -->
                <tr>
                    <th>ID</th>
                    <th>Correo</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo de Usuario</th>
                    <th>Acciones</th> <!-- Columna para acciones -->

                </tr>
            </thead>
            <tbody>
                @foreach($users as $usuari)
                <tr>

                    <td>{{ $usuario->id }}</td> <!-- ID del usuario -->
                    <td>{{ $usuario->email }}</td> <!-- Correo del usuario -->
                    <td>{{ $usuario->name }}</td> <!-- Nombre del usuario -->
                    <td>{{ $usuario->surname }}</td> <!-- Apellido del usuario -->
                    <td>
                        @if($usuario->post == 1)
                            Admin
                        @elseif($usuario->post == 2)
                            Usuario

                        @endif

                    </td>

                    <td> <!-- Acciones para cada usuario -->
                        <a href="{{ route('users.edit', $usuario->id) }}" class="btn btn-primary btn-lg" style="margin-right: 5px;">Editar</a>
                        <form action="{{ route('users.destroy', $usuario->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-lg" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">Borrar</button>

                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <ul class="pagination d-flex justify-content-center mt-4">
        <li class="page-item">
            <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)

            <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>

        @endforeach
        <li class="page-item">
            <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>

</div>

@endsection