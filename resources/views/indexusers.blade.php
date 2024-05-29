@extends('master')

@section('content')

<style>
.table {
  
  /* Cantonades arrodonides per a la taula */
  overflow: hidden;
  /* Assegura que les cantonades arrodonides s'apliquin correctament */
  font-size: 1.2em;
  /* Mida de lletra més gran */
}
.btn-d {
        transition: transform 250ms;
        color: black;
    }
.btn-d:hover {
        transform: translateY(-10px);
    }
.btn-secondary {
    
  background: linear-gradient(356deg, rgba(217, 189, 127, 1) 0%, rgba(255, 179, 0, 1) 100%);
}
.btn-info {
    background: linear-gradient(356deg, rgba(142, 152, 173, 1) 0%, rgba(0, 69, 255, 1) 100%);
}
.btn-success {
        background: linear-gradient(356deg, rgba(76, 130, 91, 1) 0%, rgba(0, 217, 102, 1) 100%);
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

.search-form {
  display: flex;
  justify-content: center;
  align-items: center;
}

.search-input {
  width: 300px;
  padding: 10px;
  border: 2px solid #ddd;
  border-radius: 5px 0 0 5px;
  font-size: 16px;
}

.search-button {
  padding: 10px 20px;
  border: 2px solid #007bff;
  background-color: #007bff;
  color: white;
  border-radius: 0 5px 5px 0;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.search-button:hover {
  background-color: #0056b3;
}
</style>

<div class="container-fluid">
  <div class="d-flex justify-content-between align-items-center my-2">
    <h1>Lista de Usuarios</h1>
    <form action="{{ route('users.index') }}" method="GET" class="search-form">
      <input type="text" name="search" placeholder="Search Products" value="{{ request('search') }}" class="search-input">
      <button type="submit" class="search-button">Search</button>
    </form>
    <form method="GET" action="{{ route('users.index') }}" class="mb-4">
      <div class="d-flex justify-content-end"> <div class="dropdown me-2"> <button class="btn-d btn-lg btn-info mt-4 dropdown-toggle" type="button" id="dropdownMenuUserType" data-bs-toggle="dropdown" aria-expanded="false">
            Tipo de usuario
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuUserType">
            <li><a class="dropdown-item" href="?post=">Todos</a></li>
            <li><a class="dropdown-item" href="?post=1">Admin</a></li>
            <li><a class="dropdown-item" href="?post=2">Usuario</a></li>
          </ul>
        </div>
        <div class="dropdown">
          <button class="btn-d btn-lg btn-secondary mt-4 ml-3 dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Ordenar por
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="?sort_order=asc">Nombre Ascendente</a></li>
<li><a class="dropdown-item" href="?sort_order=desc">Nombre Descendente</a></li>
</ul>
</div>
</div>
</form>
<a href="{{ route('users.create') }}" class="btn-d btn-success btn-lg" style="margin-right: 20px;">Crear Usuario</a>
</div>




<div class="table-responsive"> <table class="table"> <thead class="bg-light"> <tr>
        <th>ID</th>
        <th>Correo</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Tipo de Usuario</th>
        <th>Acciones</th> </tr>
    </thead>
    <tbody>
      @foreach($users as $usuario)
      <tr>
        <td>{{ $usuario->id }}</td> <td>{{ $usuario->email }}</td> <td>{{ $usuario->name }}</td> <td>{{ $usuario->surname }}</td> <td>
          @if($usuario->post == 1)
            Admin
          @elseif($usuario->post == 2)
            Usuario
          @endif
        </td>
        <td> <a href="{{ route('users.edit', $usuario->id) }}" class="btn btn-primary btn-lg" style="margin-right: 5px;">Editar</a>
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
