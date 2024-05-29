@extends('master')

@section('content')

<style>
.container {
    margin-top: 20px;
}

.bg-modul {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 20px;
    max-width: 2500px;
    /* Ancho máximo del bg-modul */
    margin: 0 auto;
    /* Margen automático para centrarlo horizontalmente */
}


.details {
    margin-bottom: 20px;
}

.circle {
    width: 30px;
    height: 30px;
    margin: 10px;
    border-radius: 50%;
}
</style>

<div class="container">
    <div class="bg-modul">
        <div class="text-center">
            @if($Upgrade->state === 'Valorandose')
            <img src="{{ asset('images/candadoAbierto.png') }}" alt="Editable" style="width:30px;">
            @else
            <img src="{{ asset('images/candadoCerrado.png') }}" alt="No editable" style="width:30px;">
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center my-4">
            <h2>Datos de la mejora</h2>
            <div>
                <a href="{{ route('upgrades.index') }}" class="btn btn-secondary">Volver Atrás</a>
                @if($Upgrade->state === 'Valorandose' && ($user->id === $Upgrade->user_id || strpos($user->post, '1')
                !== false))
                <a href="{{ route('upgrades.edit', ['upgrade'=>$Upgrade]) }}" class="btn btn-secondary">Editar</a>
                @endif

            </div>
        </div>

        <div class="row">
            <div class="col-sm">
                <div class="details">
                    <strong>Título:</strong>
                    <div style="max-width: 400px; overflow-y: auto; max-height: 100px;">{{ $Upgrade->title }}</div>
                </div>
                <div class="details">
                    <strong>Likes:</strong>
                    <div style="max-width: 400px; overflow-y: auto; max-height: 100px;">{{ $Upgrade->likes }}</div>
                </div>
                <div class="details">
                    <strong>Zona:</strong>
                    <div style="max-width: 400px; overflow-y: auto; max-height: 100px;">{{ $Upgrade->zone }}</div>
                    <div class="circle" style="background-color: 
                        @switch($Upgrade->zone)
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
                <div class="details">
                    <strong>Fecha de creación:</strong>
                    <div style="max-width: 400px; overflow-y: auto; max-height: 100px;">
                        {{ $Upgrade->created_at->format('d/m/Y') }}</div>
                </div>

                <div class="mt-3">
                    <span class="d-block mb-1"><strong>Preocupación:</strong></span>
                    <div class="form-group">
                        <div id="nota" name="nota" rows="10" disabled>{{ $Upgrade->worry }}</div>
                    </div>
                </div>

                <div class="mt-3">
                    <span class="d-block mb-1"><strong>Beneficio:</strong></span>
                    <div class="form-group">
                        <div id="nota" name="nota" rows="10" disabled>{{ $Upgrade->benefit }}</div>
                    </div>
                </div>

            </div>
            <div class="col-sm">
                @if($Upgrade->state === 'Valorandose')
                <img src="{{ asset('images/valorandose.png') }}" alt="Valorandose"
                    style="width:400px;padding-right:10px;">
                @elseif($Upgrade->state === 'En curso')
                <img src="{{ asset('images/enCurso.png') }}" alt="En Curso" style="width:425px;padding-right:10px;">
                @elseif($Upgrade->state === 'Resuelta')
                <img src="{{ asset('images/resuelta.png') }}" alt="Resuelta" style="width:455px;padding-right:10px;">
                @endif
            </div>
        </div>
    </div>
</div>
@endsection