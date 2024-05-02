@extends('master')

@section('content')
<style>
  .upgrade-card {
    display: block;
  }

  .modal-hidden {
    display: none;
  }
</style>
<div class="container-fluid">
  <div class="row">
    <!-- Columna izquierda para los filtros -->
    <div class="col mt-4"> <!-- Añadido margen superior -->
      <div class="d-flex flex-column align-items-start" style="border-radius:10px;padding-left:10px;">
        <div class="d-flex align-items-center">
          <h5 style="margin-bottom:2px;">Medicamentos</h5>
          <div style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #F94537;"></div>
        </div>
        <div class="d-flex align-items-center">
          <h5 style="margin-bottom:2px;">Sanitaria</h5>
          <div style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #8AE34B;"></div>
        </div>
        <div class="d-flex align-items-center">
          <h5 style="margin-bottom:2px;">Cosmeticos</h5>
          <div style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #3A3AD4;"></div>
        </div>
        <div class="d-flex align-items-center">
          <h5 style="margin-bottom:2px;">Control de calidad</h5>
          <div style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #AEAEAE;"></div>
        </div>
      </div>
    </div>

    <!-- Columna derecha para el contenido principal -->
    <div class="col-lg-9">
      <div class="d-flex justify-content-between align-items-center my-4">
        <!-- Botón de Filtratge -->
        <button type="button" class="btn btn-primary ms-4 btn-lg" data-bs-toggle="modal" data-bs-target="#filterModal">
          Filtrar
        </button>
        <a href="{{ route('upgrades.create') }}" class="btn btn-success ms-4 btn-lg" style="margin-right:20px;">Crear Mejora</a>
      </div>

      <!-- Contenido de la lista de upgrades -->
      <div class="container">
        <div class="row">
          @foreach($upgrades as $upgrade)
          <div class="col-md-6 mb-4 upgrade-card" style="display: block;" 
               data-zone="{{ $upgrade->zone }}" 
               data-likes="{{ $upgrade->likes }}" 
               data-state="{{ $upgrade->state }}">
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
                <a href="{{ route('upgrades.show', $upgrade->id) }}" class="btn btn-primary btn-sm">Veure Detalls</a>
              </div>
            </div>
          </div>

          @if ($loop->iteration % 2 == 0) </div>
        <div class="row">
          @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const filterForm = document.querySelector('form');
    const filterModal = document.getElementById('filterModal');

    filterForm.addEventListener('submit', function(event) {
      event.preventDefault();
      applyFilters();
      closeFilterModal();
    });

    const closeButton = document.querySelector('.modal-header .btn-close');
    closeButton.addEventListener('click', closeFilterModal);

    function applyFilters() {
      const zoneFilterValue = document.querySelector('#zoneFilter').value;
      const likesFilterValue = document.querySelector('#likesFilter').value;
      const stateFilterValue = document.querySelector('#stateFilter').value;
      const upgradeCards = document.querySelectorAll('.upgrade-card');

      upgradeCards.forEach(function(card) {
        const zone = card.dataset.zone;
        const likes = parseInt(card.dataset.likes);
        const state = card.dataset.state;
        const zoneFilterPassed = zoneFilterValue === '' || zone === zoneFilterValue;
        const likesFilterPassed = likesFilterValue === '' || (likesFilterValue === 'mas' && likes > 0) || (likesFilterValue === 'menos' && likes === 0);
        const stateFilterPassed = stateFilterValue === '' || (stateFilterValue === 'Valoracion' && state === 'Valorandose') || state === stateFilterValue;

        if (zoneFilterPassed && likesFilterPassed && stateFilterPassed) {
          card.style.display = 'block'; 
        } else {
          card.style.display = 'none'; 
        }
      });
    }

    function closeFilterModal() {
      filterModal.classList.add('modal-hidden');
    }

    function openFilterModal() {
      filterModal.classList.remove('modal-hidden');
    }
  });
</script>

@endsection
