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
    <!-- Botó de Filtratge -->
    <!--<button type="button" class="btn btn-primary ms-4 btn-lg" data-bs-toggle="modal" data-bs-target="#filterModal">
      Filtrar
    </button>-->
    <div class="col d-flex justify-content-end align-items-center">
        <a href="{{ route('upgrades.create') }}" class="btn btn-success btn-lg" style="margin-right:20px;">Crear Millora</a>
        <a href="{{ route('my.upgrades') }}" class="btn btn-primary btn-lg">Mis Upgrades</a>
      </div>
  </div>


  <div class="row">
    <div class="col mt-3 w-25">
      <div class="card border-black border-2 shadow">
        <div class="card-body">
          <h4>Filtre de zones:</h4>
          <div class="d-flex flex-column align-items-start" style="border-radius:10px;padding-left:10px;">
            <div class="d-flex align-items-center">
              <div style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #F94537;"></div>
              <h5 class="zone-filter" data-zone="medicamentos" style="margin-bottom:2px;">Medicamentos</h5>
            </div>
            <div class="d-flex align-items-center">
              <div style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #8AE34B;"></div>
              <h5 class="zone-filter" data-zone="sanitaria" style="margin-bottom:2px;">Sanitaria</h5>
            </div>
            <div class="d-flex align-items-center">
              <div style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #3A3AD4;"></div>
              <h5 class="zone-filter" data-zone="cosmeticos" style="margin-bottom:2px;">Cosméticos</h5>
            </div>
            <div class="d-flex align-items-center">
              <div style="width: 20px; height: 20px; margin: 10px;padding: 10px;margin-bottom:10px; border-radius: 50%; background-color: #AEAEAE;"></div>
              <h5 class="zone-filter" data-zone="control de calidad" style="margin-bottom:2px;">Control de calidad</h5>
            </div>
            <div class="d-flex align-items-center">
              <h5 class="zone-filter" data-zone="todos" style="margin-bottom:2px;">Todas</h5>
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
  // Añadimos un event listener a todos los elementos .zone-filter
  document.querySelectorAll('.zone-filter').forEach(item => {
    item.addEventListener('click', event => {
      // Codificar el nombre de la zona antes de concatenarlo al URL
      const zoneName = encodeURIComponent(item.dataset.zone);
      // Redirigir a la nueva ruta de filtrado con la zona seleccionada
      window.location.href = "{{ url('/upgrades/filter/') }}" + '/' + zoneName;
    });
  });
</script>


@endsection
