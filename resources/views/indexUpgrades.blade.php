@extends('master')

@section('content')
<style>
.upgrade-card {
    display: block;
}

.modal-hidden {
    display: none;
}

/* Afegim un cursor de punter i un color blau al passar el ratolí sobre les zones */
.zone-filter {
    cursor: pointer;
}

.zone-filter:hover {
    color: blue;
}
</style>

<div class="container-fluid">
  <div class="row mt-3 ml-1">
      <div class="col">
          <h2 class="mb-0">Llista de millores</h2>
      </div>
      <div class="col d-flex align-items-center">
          <!-- Aquí comença la barra de cerca -->
          <form id="search-form" class="input-group"> <!-- Afegim un ID al formulari -->
            <input id="search-input" type="text" class="form-control" placeholder="Cerca..." aria-label="Cerca">
            <button id="search-button"class="btn btn-outline-secondary" type="submit">Cercar</button>
          </form>

          <!-- Aquí acaba la barra de cerca -->
      </div>
      <div class="col-auto d-flex justify-content-end">
          <div class="dropdown">
              <button class="btn btn-lg btn-secondary dropdown-toggle m-2" type="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Ordenar per
              </button>
              <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="?sort_by=likes&sort_direction=asc">Likes Asc</a></li>
                  <li><a class="dropdown-item" href="?sort_by=likes&sort_direction=desc">Likes Desc</a></li>
                  <li><a class="dropdown-item" href="?sort_by=title&sort_direction=asc">Titol Asc</a></li>
                  <li><a class="dropdown-item" href="?sort_by=title&sort_direction=desc">Titol Desc</a></li>
              </ul>
          </div>
          <a href="{{ route('upgrades.create') }}" class="btn btn-success btn-lg m-2">Crear Millora</a>
          <a href="{{ route('my.upgrades') }}" class="btn btn-primary btn-lg m-2">Mis Upgrades</a>
      </div>
  </div>




    <div class="row">
        <div class="col mt-3 w-5">
            <div class="card border-black border-2 shadow">
                <div class="card-body">
                    <h4>Filtre de zones:</h4>
                    <div class="d-flex flex-column align-items-start" style="border-radius:10px;padding-left:10px;">
                        <div class="d-flex align-items-center">
                            <div
                                style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #F94537;">
                            </div>
                            <h5 class="zone-filter" data-zone="medicamentos" style="margin-bottom:2px;">Medicamentos
                            </h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <div
                                style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #8AE34B;">
                            </div>
                            <h5 class="zone-filter" data-zone="sanitaria" style="margin-bottom:2px;">Sanitaria</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <div
                                style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #3A3AD4;">
                            </div>
                            <h5 class="zone-filter" data-zone="cosmeticos" style="margin-bottom:2px;">Cosméticos</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <div
                                style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #AEAEAE;">
                            </div>
                            <h5 class="zone-filter" data-zone="control de calidad" style="margin-bottom:2px;">Control de
                                calidad</h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <h5 class="zone-filter" data-zone="todos" style="margin-bottom:2px;">Limpiar Filtro</h5>
                        </div>
                    </div>
                    <br>
                    <h4>Filtre d'estat</h4>
                    <div class="d-flex flex-column align-items-start" style="border-radius:10px;padding-left:10px;">

                        <div class="d-flex align-items-center">
                            <i class="fas fa-hourglass-half" style="margin: 10px;margin-left:12px;"></i>
                            <!-- Ícono para "Valorant-se" -->
                            <h5 class="zone-filter" data-zone="valorandose" style="margin-bottom:2px;">Valorandose</h5>
                        </div>

                        <div class="d-flex align-items-center">
                            <i class="fas fa-spinner" style="margin: 10px;"></i> <!-- Ícono para "En curs" -->
                            <h5 class="zone-filter" data-zone="en_curso" style="margin-bottom:2px;">En curso</h5>
                        </div>

                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle" style="margin: 10px;"></i> <!-- Ícono para "Resolta" -->
                            <h5 class="zone-filter" data-zone="resuelta" style="margin-bottom:2px;">Resuelta</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-9 w-50 mt-3">
            <!-- Contenido de la llista de millores -->
            <div class="container">
                <div class="row" id="upgrade-list">
                    @foreach($upgrades as $upgrade)
                    <div class="col-md-6 mb-4 upgrade-card" style="display: block;" data-zone="{{ $upgrade->zone }}"
                        data-likes="{{ $upgrade->likes }}" data-state="{{ $upgrade->state }}">
                        <div class="card border-10 shadow h-100 d-flex flex-column" style="border-radius:10px;">
                            <img src="{{ $upgrade->image }}" class="card-img-top" alt="{{ $upgrade->name }}">
                            <div class="card-body d-flex flex-grow-1 justify-content-between align-items-stretch">
                                <div class="d-flex flex-column">
                                    <div>
                                        <h5 class="card-title">{{ $upgrade->title }}</h5>
                                        <p class="card-text"><b>Estat:</b> {{ $upgrade->state }}</p>
                                        <p class="card-text"><b>Likes:</b> {{ $upgrade->likes }}</p>
                                        <p class="card-text"><b>Zona:</b> {{ $upgrade->zone }}</p>
                                    </div>
                                    <div style="position: absolute; top: 0; right: 0;">
                                        <div style="width: 30px; height: 30px; margin: 10px; border-radius: 50%; background-color: 
                                          @switch($upgrade->zone)
                                              @case('Cosmeticos')
                                                  #3A3AD4
                                                  @break
                                              @case('Medicamentos')
                                                  #F94537
                                                  @break
                                              @case('Sanitaria')
                                                  #8AE34B
                                                  @break
                                              @case('Control de calidad')
                                                  #AEAEAE
                                                  @break
                                              @default
                                                  #000000
                                          @endswitch
                                      ;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <span class="card-text mb-0">{{ $upgrade->created_at->format('d/m/Y') }}</span>
                                <a href="{{ route('upgrades.show', $upgrade->id) }}" class="btn btn-primary ">Veure
                                    Detalls</a>
                            </div>
                        </div>
                    </div>

                    @if ($loop->iteration % 2 == 0)
                </div>
                <div class="row">
                    @endif
                    @endforeach
                </div>
            </div>


            <ul class="pagination d-flex justify-content-center mt-4">
                <li class="page-item">
                    <a class="page-link" href="{{ $upgrades->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                @foreach ($upgrades->getUrlRange(1, $upgrades->lastPage()) as $page => $url)
                <li class="page-item {{ $upgrades->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
                @endforeach
                <li class="page-item">
                    <a class="page-link" href="{{ $upgrades->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>


        </div>
    </div>
</div>

<script>
// Añadimos un event listener a todos los elementos .zone-filter
document.querySelectorAll('.zone-filter').forEach(item => {
    item.addEventListener('click', event => {
        // Codificar el nombre de la zona antes de concatenarlo al URL
        const zoneName = encodeURIComponent(item.dataset.zone);
        if(zoneName === "todos"){
        window.location.href = "{{ url('upgrades') }}";
      } else {
        window.location.href = "{{ url('/upgrades/filter/') }}" + '/' + zoneName;
      }
       
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const searchButton = document.getElementById('search-button');
    if(searchButton){
        searchButton.addEventListener('click', function(event) {
            event.preventDefault(); // Evitar que el formulari s'envii

            const query = encodeURIComponent(document.getElementById('search-input').value);
            const searchUrl = "{{ route('upgrades.search') }}"; // Utilitzar la ruta correcta per a la cerca

            // Fer la sol·licitud AJAX
            fetch(searchUrl + '?query=' + query)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("S'ha produït un error en processar la cerca.");
                    }
                    return response.json(); // Convertir la resposta a JSON
                })
                .then(data => {
                    // Manipular la resposta segons les necessitats
                    console.log(data);
                    // Actualitzar la llista de millores amb els resultats de la cerca
                    updateUpgradeList(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    }
});



</script>


@endsection