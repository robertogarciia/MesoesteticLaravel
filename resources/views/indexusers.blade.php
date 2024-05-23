@extends('master')

@section('content')

<style>
    .table {
        border-radius: 20px; /* Cantonades arrodonides per a la taula */
        overflow: hidden; /* Assegura que les cantonades arrodonides s'apliquin correctament */
        font-size: 1.2em; /* Mida de lletra més gran */
    }
    .table th, .table td {
        padding: 12px; /* Espaiat per a les cel·les */
        text-align: left; /* Alineació de text */
        border-bottom: 1px solid #ddd; /* Vora inferior per a files */
    }
    .table thead {
        background-color: #f2f2f2; /* Fons per als encapçalaments */
        font-weight: bold; /* Negreta per als encapçalaments */
    }
</style>

<div class="container-fluid"> <!-- Contenidor més ampli -->
    <div class="d-flex justify-content-between align-items-center my-4">
        <h1>Llista d'Usuaris</h1>
        <a href="{{ route('users.create') }}" 
           class="btn btn-success btn-lg" 
           style="margin-right: 20px;">Crear Usuari
        </a>
    </div>

    <div class="table-responsive"> <!-- Per adaptar-se a diferents mides de pantalla -->
        <table class="table"> <!-- Taula amb cantonades arrodonides -->
            <thead class="bg-light"> <!-- Encapçalaments destacats -->
                <tr>
                    <th>ID</th>
                    <th>Correu</th>
                    <th>Càrrec</th>
                    <th>Accions</th> <!-- Columna per a accions -->
                </tr>
            </thead>
            <tbody>
                @foreach($users as $usuari)
                <tr>
                    <td>{{ $usuari->id }}</td> <!-- ID de l'usuari -->
                    <td>{{ $usuari->email }}</td> <!-- Correu de l'usuari -->
                    <td>
                        @if($usuari->post == 1)
                            Admin
                        @else
                            Usuari
                        @endif
                    </td>
                    <td> <!-- Accions per a cada usuari -->
                        <a href="{{ route('users.edit', $usuari->id) }}" 
                           class="btn btn-primary btn-lg" 
                           style="margin-right: 5px;">
                           Editar
                        </a>
                        <form action="{{ route('users.destroy', $usuari->id) }}" 
                              method="POST" 
                              style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="btn btn-danger btn-lg" 
                                    onclick="return confirm('Estàs segur que vols eliminar aquest usuari?')">
                                    Esborrar
                            </button>
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
