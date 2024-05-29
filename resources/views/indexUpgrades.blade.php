@extends('master')

@section('content')
<style>
#pag {
    margin-left: 710px;
}

.upgrade-card {
    display: block;
}

.btn-d {
    transition: transform 250ms;
    color: black;
}

.btn {
    transition: transform 250ms;
    color: black;
}

.btn-success {
    background: linear-gradient(356deg, rgba(76, 130, 91, 1) 0%, rgba(0, 217, 102, 1) 100%);
}

.btn-info {
    background: linear-gradient(356deg, rgba(142, 152, 173, 1) 0%, rgba(0, 69, 255, 1) 100%);
}

.btn-secondary {
    background: linear-gradient(356deg, rgba(217, 189, 127, 1) 0%, rgba(255, 179, 0, 1) 100%);
}

.btn-d:hover {
    transform: translateY(-10px);
}

.zone-filter,
.state-filter {
    cursor: pointer;
}

.zone-filter:hover,
.state-filter:hover {
    color: blue;
}

.active-filter {
    color: green;
    font-weight: bold;
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
    <div class="row mt-3 ml-1">
        <div class="col">
            <h2 class="mb-0">Lista de mejoras</h2>
        </div>
        <!-- comentario en html =  -->
        <form action="{{ route('upgrades.index') }}" method="GET" class="search-form">
            <input type="text" name="search" placeholder="Search Products" value="{{ request('search') }}"
                class="search-input">
            <button type="submit" class="search-button">Search</button>
        </form>
        <div class="col-auto d-flex justify-content-end">
            <div class="dropdown">
                <button class="btn-d btn-lg btn-secondary dropdown-toggle m-2" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Ordenar por
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item"
                            href="?sort_by=likes&sort_direction=asc&zone={{ $zone }}&state={{ $state }}&start_date={{ $start_date }}&end_date={{ $end_date }}">Likes
                            Asc</a></li>
                    <li><a class="dropdown-item"
                            href="?sort_by=likes&sort_direction=desc&zone={{ $zone }}&state={{ $state }}&start_date={{ $start_date }}&end_date={{ $end_date }}">Likes
                            Desc</a></li>
                    <li><a class="dropdown-item"
                            href="?sort_by=title&sort_direction=asc&zone={{ $zone }}&state={{ $state }}&start_date={{ $start_date }}&end_date={{ $end_date }}">Titol
                            Asc</a></li>
                    <li><a class="dropdown-item"
                            href="?sort_by=title&sort_direction=desc&zone={{ $zone }}&state={{ $state }}&start_date={{ $start_date }}&end_date={{ $end_date }}">Titol
                            Desc</a></li>
                </ul>
            </div>
            <a href="{{ route('upgrades.create') }}" class="btn-d btn-success btn-lg m-2">Crear mejora</a>
            <a href="{{ route('my.upgrades') }}" class="btn-d btn-info btn-lg m-2">Mis mejoras</a>
        </div>
    </div>

    <div class="row">
        <div class="col mt-3 w-5">
            <div class="card border-black border-2 shadow">
                <div class="card-body">
                    <h4>Filtro por zonas :</h4>
                    <div class="d-flex flex-column align-items-start" style="border-radius:10px;padding-left:10px;">
                        @foreach (['medicamentos' => '#F94537', 'sanitaria' => '#8AE34B', 'cosmeticos' => '#3A3AD4',
                        'Control de calidad' => '#bfbfbf'] as $zoneName => $color)
                        <div class="d-flex align-items-center">
                            <div
                                style="width: 20px; height: 20px; margin: 10px; padding: 10px; margin-bottom:10px; border-radius: 50%; background-color: {{ $color }};">
                            </div>
                            <h5 class="zone-filter {{ $zone == $zoneName ? 'active-filter' : '' }}"
                                data-zone="{{ $zoneName }}">{{ ucfirst($zoneName) }}</h5>
                        </div>
                        @endforeach
                    </div>

                    <h4 style="margin-top:5px;margin-bottom:15px;">Filtro por estado: </h4>
                    <div class="d-flex flex-column alignments-start" style="border-radius:10px;padding-left:10px;">
                        @foreach (['valorandose' => 'hourglass-half', 'En curso' => 'spinner', 'resuelta' =>
                        'check-circle'] as $stateName => $icon)
                        <div class="d-flex alignments-center">
                            <i class="fas fa-{{ $icon }}" style="margin: 15px; margin-top:5px; margin-left:12px;"></i>
                            <h5 class="state-filter {{ $state == $stateName ? 'active-filter' : '' }}"
                                data-state="{{ $stateName }}">{{ ucfirst($stateName) }}</h5>
                        </div>
                        @endforeach
                    </div>

                    <h4 style="margin-top:5px;margin-bottom:15px;">Filtro por fecha: </h4>
                    <div class="d-flex flex-column alignments-start" style="border-radius:10px;padding-left:10px;">
                        <form method="GET" action="{{ route('upgrades.index') }}">
                            @foreach (['sort_by', 'sort_direction', 'zone', 'state'] as $inputName)
                            <input type="hidden" name="{{ $inputName }}" value="{{ ${$inputName} }}">
                            @endforeach
                            <div class="col-12">
                                <label for="start_date">Desde:</label>
                                <input id="start_date" type="date" name="start_date" class="form-control"
                                    value="{{ $start_date }}" required>
                            </div>
                            <div class="col-12">
                                <label for="end_date">Hasta:</label>
                                <input id="end_date" type="date" name="end_date" class="form-control"
                                    value="{{ $end_date }}" required>
                            </div>
                            <div class="col-12 pt-3">
                                <button type="submit" class="btn btn-primary">Filtrar por fecha</button>
                            </div>
                        </form>
                        <a href="{{ route('upgrades.index') }}" style="text-decoration: none;">
                            <div class="d-flex align-items-center" style="margin-top: 8px; margin-left: 14px;">
                                <h5 class="zone-filter {{ $zone == 'todos' ? 'active-filter' : '' }}" data-zone="todos">
                                    Limpiar Filtro</h5>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-9 w-50 mt-3">
            <div class="container">
                <div class="row" id="upgrade-list">
                    @foreach($upgrades as $upgrade)
                    <div class="col-md-6 mb-4 upgrade-card" data-zone="{{ $upgrade->zone }}"
                        data-likes="{{ $upgrade->likes }}" data-state="{{ $upgrade->state }}">
                        <div class="card border-10 shadow h-100 d-flex flex-column" style="border-radius:10px;">
                            <img src="{{ $upgrade->image }}" class="card-img-top" alt="{{ $upgrade->name }}">
                            <div class="card-body d-flex flex-grow-1 justify-content-between align-items-stretch">
                                <div class="d-flex flex-column">
                                    <div>
                                        <h5 class="card-title">{{ $upgrade->title }}</h5>
                                        <p class="card-text"><b>Estat:</b> {{ $upgrade->state }}</p>
                                        <p class="card-text"><b>Likes:</b> <span
                                                id="like-count-{{ $upgrade->id }}">{{ $upgrade->likes }}</span></p>
                                        <p class="card-text"><b>Zona:</b> {{ $upgrade->zone }}</p>
                                    </div>
                                    <div style="position: absolute; top: 0; right: 0;">
                                        <div style="width: 30px; height: 30px; margin: 10px; border-radius: 50%; background-color: 
                                                @switch($upgrade->zone)
                                                    @case('Cosmeticos') #3A3AD4 @break
                                                    @case('Medicamentos') #F94537 @break
                                                    @case('Sanitaria') #8AE34B @break
                                                    @case('Control de calidad') #AEAEAE @break
                                                    @default #000000
                                                @endswitch">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <span class="card-text mb-0">{{ $upgrade->created_at->format('d/m/Y') }}</span>
                                <a href="{{ route('upgrades.show', $upgrade->id) }}" class="btn btn-primary">Ver
                                    detalles</a>
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
        </div>

        <ul class="pagination d-flex justify-content-center mt-4 " id="pag">
            <li class="page-item {{ $upgrades->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $upgrades->url(1) }}" aria-label="First">1</a>
            </li>
            <li class="page-item {{ $upgrades->previousPageUrl() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $upgrades->previousPageUrl() }}" aria-label="Previous">&laquo;</a>
            </li>
            @for ($i = $startPage; $i <= $endPage; $i++) <li class="page-item {{ $currentPage == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $upgrades->url($i) }}">{{ $i }}</a>
                </li>
                @endfor
                <li class="page-item {{ $upgrades->nextPageUrl() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $upgrades->nextPageUrl() }}" aria-label="Next">&raquo;</a>
                </li>
                <li class="page-item {{ $upgrades->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $upgrades->url($totalPages) }}"
                        aria-label="Last">{{ $totalPages }}</a>
                </li>
        </ul>
    </div>
</div>

<script>
function handleFilterClick(element, parameterName) {
    const currentUrl = new URL(window.location);
    const parameterValue = encodeURIComponent(element.dataset[parameterName]);

    if (parameterValue === "todos") {
        currentUrl.searchParams.delete(parameterName);
    } else {
        currentUrl.searchParams.set(parameterName, parameterValue.replace(" ", "-"));
    }

    window.location.href = currentUrl.toString();
}

document.querySelectorAll('.zone-filter').forEach((item) => {
    item.addEventListener('click', () => handleFilterClick(item, 'zone'));
});

document.querySelectorAll('.state-filter').forEach((item) => {
    item.addEventListener('click', () => handleFilterClick(item, 'state'));
});
</script>

@endsection