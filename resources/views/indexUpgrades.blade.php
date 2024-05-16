@extends('master')

@section('content')
<style>
.upgrade-card {
    display: block;
}

.modal-hidden {
    display: none;
}

.btn-success {
    background: rgb(76, 130, 91);
    background: linear-gradient(356deg, rgba(76, 130, 91, 1) 0%, rgba(0, 217, 102, 1) 100%);
    color: black;
    transition: transform 250ms;
}

.btn-info {
    background: rgb(142, 152, 173);
    background: linear-gradient(356deg, rgba(142, 152, 173, 1) 0%, rgba(0, 69, 255, 1) 100%);
    color: black;
    transition: transform 250ms;
}

.btn-secondary {
    background: rgb(217, 189, 127);
    background: linear-gradient(356deg, rgba(217, 189, 127, 1) 0%, rgba(255, 179, 0, 1) 100%);
    color: Black;
    transition: transform 250ms;
}

.btn-success:hover {
    transform: translateY(-10px);

}

.btn-secondary:hover {
    transform: translateY(-10px);
}

.btn-info:hover {
    transform: translateY(-10px);

}


/* Afegim un cursor de punter i un color blau al passar el ratolí sobre les zones */
.zone-filter {
    cursor: pointer;
}

.zone-filter:hover {
    color: blue;
}

.state-filter {
    cursor: pointer;

}

.state-filter:hover {
    color: blue;
}

.active-filter {
    color: green;
    font-weight: bold;

}
</style>

<div class="container-fluid">
    <div class="row mt-3 ml-1">
        <div class="col">
            <h2 class="mb-0">Lista de mejoras</h2>
        </div>
        <div class="col d-flex align-items-center">
            <form id="search-form" class="input-group">
                <input id="search-input" type="text" class="form-control" placeholder="Cerca..." aria-label="Cerca">
                <button id="search-button" class="btn btn-outline-secondary" type="submit">Cercar</button>
            </form>
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
            <a href="{{ route('upgrades.create') }}" class="btn btn-success btn-lg m-2">Crear mejora</a>
            <a href="{{ route('my.upgrades') }}" class="btn btn-info     btn-lg m-2">Mis mejoras</a>
        </div>
    </div>

    <div class="row">
        <div class="col mt-3 w-5">
            <div class="card border-black border-2 shadow">
                <div class="card-body">
                    <h4>Filtro por zonas :</h4>
                    <div class="d-flex flex-column align-items-start" style="border-radius:10px;padding-left:10px;">
                        <div class="d-flex align-items-center">
                            <div
                                style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #F94537;">
                            </div>


                            <h5 class="zone-filter {{ $zone == 'medicamentos' ? 'active-filter' : '' }}"
                                data-zone="medicamentos">
                                Medicamentos
                            </h5>

                        </div>
                        <div class="d-flex align-items-center">
                            <div
                                style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #8AE34B;">
                            </div>
                            <h5 class="zone-filter {{ $zone == 'sanitaria' ? 'active-filter' : '' }}"
                                data-zone="sanitaria">Sanitaria
                            </h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <div
                                style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #3A3AD4;">
                            </div>
                            <h5 class="zone-filter {{ $zone == 'cosmeticos' ? 'active-filter' : '' }}"
                                data-zone="cosmeticos">Cosméticos
                            </h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <div
                                style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #bfbfbf;">
                            </div>
                            <h5 class="zone-filter {{ $zone == 'Control de calidad' ? 'active-filter' : '' }}"
                                data-zone="Control de calidad">Control de calidad
                            </h5>
                        </div>

                    </div>

                    <h4 style="margin-top:5px;margin-bottom:15px;">Filtro por estado: </h4>
                    <div class="d-flex flex-column alignments-start" style="border-radius:10px;padding-left:10px;">

                        <div class="d-flex alignments-center">
                            <i class="fas fa-hourglass-half" style="margin: 15px;margin-top:5px;margin-left:14px;"></i>
                            <!-- Ícono para "Valorándose" -->


                            <h5 class="state-filter {{ $state == 'valorandose' ? 'active-filter' : '' }}"
                                data-state="Valorandose">
                                Valorándose
                            </h5>

                        </div>

                        <div class="d-flex alignments-center">
                            <i class="fas fa-spinner" style="margin: 15px;margin-top:5px;margin-left:12px;"></i>
                            <h5 class="state-filter {{ $state == 'encurso' ? 'active-filter' : '' }}"
                                data-state="En curso">En curso
                            </h5>
                        </div>

                        <div class="d-flex alignments-center">
                            <i class="fas fa-check-circle" style="margin: 15px;margin-top:5px;margin-left:12px;"></i>
                            <h5 class="state-filter {{ $state == 'resuelta' ? 'active-filter' : '' }}"
                                data-state="Resuelta">Resuelta
                            </h5>
                        </div>

                    </div>
                    <h4 style="margin-top:5px;margin-bottom:15px;">Filtro por fecha: </h4>
                    <div class="d-flex flex-column alignments-start" style="border-radius:10px;padding-left:10px;">
                        <form method="GET" action="{{ route('upgrades.index') }}">
                            <!-- Ajustar el action para que apunte a la función 'index' -->
                            <div class="col-12">
                                <label for="start_date">Desde:</label>
                                <input id="start_date" type="date" name="start_date" class="form-control"
                                    value="{{ $start_date }}" required> <!-- Mantener el valor actual -->
                            </div>
                            <div class="col-12">
                                <label for="end_date">Hasta:</label>
                                <input id="end_date" type="date" name="end_date" class="form-control"
                                    value="{{ $end_date }}" required> <!-- Mantener el valor actual -->
                            </div>
                            <div class="col-12 pt-3">
                                <button type="submit" class="btn btn-primary">Filtrar por fecha</button>
                            </div>
                        </form>
                        <div class="d-flex alignments-center" style="margin-top:8px;margin-left:14px;">
                            <h5 class="zone-filter {{ $zone == 'todos' ? 'active-filter' : '' }}" data-zone="todos">
                                Limpiar Filtro</h5>
                        </div>

                    </div>

                </div>
            </div>
        </div>


        <div class="col-lg-9 w-50 mt-3">
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
                  <p class="card-text"><b>Likes:</b> <span id="like-count-{{ $upgrade->id }}">{{ $upgrade->likes }}</span></p>
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
                  ">
                    
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
              <span class="card-text mb-0">{{ $upgrade->created_at->format('d/m/Y') }}</span>
              <a href="{{ route('upgrades.show', $upgrade->id) }}" class="btn btn-primary ">Ver detalles</a>
            </div>
          </div>
        </div>

        @if ($loop->iteration % 2 == 0)
        </div>
        <div class="row">
        @endif
      @endforeach
    </div>
    <div id="resultats-cerca"></div>
  </div>
</div>



            <ul class="pagination d-flex justify-content-center mt-4">
                <!-- Botón para ir a la página anterior -->

                <li class="page-item">
                    <a class="page-link" href="{{ $upgrades->url(1) }}" aria-label="First">
                        1
                    </a>
                </li>
                <li class="page-item {{ $upgrades->currentPage() == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $upgrades->previousPageUrl() }}" aria-label="Previous">
                        &laquo;
                    </a>
                </li>

                <!-- Mostrar el rango de páginas calculado -->
                @for ($i = $startPage; $i <= $endPage; $i++) <li
                    class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                    <a class="page-link" href="{{ $upgrades->url($i) }}">{{ $i }}</a>
                    </li>
                    @endfor

                    <!-- Botón para ir a la página siguiente -->
                    <li class="page-item {{ $upgrades->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $upgrades->nextPageUrl() }}" aria-label="Next">
                            &raquo;
                        </a>
                    </li>
                    <!-- Botón para ir a la última página -->
                    <li class="page-item {{ $upgrades->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $upgrades->url($totalPages) }}" aria-label="Last">
                            {{ $totalPages }}
                        </a>
                    </li>

            </ul>



        </div>
    </div>
</div>

<script>
function handleFilterClick(element, parameterName) {
    const currentUrl = new URL(window.location); // Obtener la URL actual
    const parameterValue = encodeURIComponent(element.dataset[parameterName]);

    // Establecer o quitar el parámetro según el valor
    if (parameterValue === "todos") {
        currentUrl.searchParams.delete(parameterName); // Eliminar el parámetro si es "todos"
    } else {
        currentUrl.searchParams.set(parameterName, parameterValue.toString().replace(" ", "-")); // Establecer el nuevo valor
    }

    // Redirigir a la nueva URL con los parámetros correctos
    window.location.href = currentUrl.toString();
}

// Aplicar el evento de clic para zona
document.querySelectorAll('.zone-filter').forEach((item) => {
    item.addEventListener('click', () => handleFilterClick(item, 'zone'));
});

// Aplicar el evento de clic para estado
document.querySelectorAll('.state-filter').forEach((item) => {
    item.addEventListener('click', () => handleFilterClick(item, 'state'));
});





document.addEventListener('DOMContentLoaded', function() {
    const searchButton = document.getElementById('search-button');
    if (searchButton) {
        searchButton.addEventListener('click', function(event) {
            event.preventDefault(); // Evitar que el formulari s'envii

            const query = encodeURIComponent(document.getElementById('search-input').value);
            const searchUrl =
                "{{ route('upgrades.search') }}"; // Utilitzar la ruta correcta per a la cerca

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

fetch('{{ route('upgrades.search') }}') // Utilitzar la ruta correcta per a la cerca
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
        console.error('Error en obtenir els resultats de la cerca:', error);
    });

// Funció per actualitzar la llista de millores amb els resultats de la cerca
function updateUpgradeList(upgrades) {
    const resultatsCerca = document.getElementById('resultats-cerca');
    resultatsCerca.innerHTML = ''; // Netegem el contingut anterior

    // Recorrem tots els resultats i els afegim com elements de llista al div
    upgrades.forEach(function(upgrade) {
        const li = document.createElement('li');
        li.textContent = upgrade.title;
        resultatsCerca.appendChild(li);
    });
}

</script>


@endsection