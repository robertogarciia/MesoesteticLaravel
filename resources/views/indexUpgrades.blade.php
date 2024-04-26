@extends('master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>Llista de millores</h2>
        <a href="{{ route('upgrades.create') }}" class="btn btn-success">Crear Mejora</a>
    </div>

    <div class="row">
        @foreach($upgrades as $upgrade)
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow h-100 d-flex flex-column">
                    <img src="{{ $upgrade->image }}" class="card-img-top" alt="{{ $upgrade->name }}">
                    <div class="card-body d-flex flex-grow-1 justify-content-between align-items-stretch">
                        <div class="d-flex flex-column">
                            <div>
                                <h5 class="card-title">{{ $upgrade->title }}</h5>
                                <p class="card-text"><b>Estado:</b> {{ $upgrade->state }}</p>
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
                        <a href="{{ route('upgrades.show', $upgrade->id) }}" class="btn btn-primary btn-sm">Show Details</a>                 
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
@endsection
