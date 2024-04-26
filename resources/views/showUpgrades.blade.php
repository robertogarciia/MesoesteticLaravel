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
        <div class="d-flex justify-content-between align-items-center my-4">
            <h2>Datos de la mejora</h2>
            <div>
                <a href="{{ route('upgrades.index') }}" class="btn btn-secondary">Volver Atrás</a>
                @if($Upgrade->state === 'Valorandose')
                    <a href="{{ route('upgrades.edit', ['upgrade'=>$Upgrade]) }}" class="btn btn-secondary">Editar</a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="details">
                    <strong>Título:</strong>
                    <div class="form-control editable" style="max-width: 400px; overflow-y: auto; max-height: 100px;">{{ $Upgrade->title }}</div>
                </div>
                <div class="details">
                    <strong>Estado:</strong>
                    <div class="form-control editable" style="max-width: 400px; overflow-y: auto; max-height: 100px;">{{ $Upgrade->state }}</div>
                </div>
                <div class="details">
                    <strong>Likes:</strong>
                    <div class="form-control editable" style="max-width: 400px; overflow-y: auto; max-height: 100px;">{{ $Upgrade->likes }}</div>
                </div>
                <div class="details">
                    <strong>Zona:</strong>
                    <div class="form-control editable" style="max-width: 400px; overflow-y: auto; max-height: 100px;">{{ $Upgrade->zone }}</div>
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
                    <div class="form-control editable" style="max-width: 400px; overflow-y: auto; max-height: 100px;">{{ $Upgrade->created_at->format('d/m/Y') }}</div>
                </div>
            </div>
            <div class="col">
                <div class="mt-3">
                    <span class="d-block mb-1"><strong>Preocupación:</strong></span>
                    <div class="form-group">
                        <textarea id="nota" name="nota" class="form-control mt-2 w-100" rows="10" disabled>{{ $Upgrade->worry }}</textarea>
                    </div>
                </div>

                <div class="mt-3">
                    <span class="d-block mb-1"><strong>Beneficio:</strong></span>
                    <div class="form-group">
                        <textarea id="nota" name="nota" class="form-control mt-2 w-100" rows="10" disabled>{{ $Upgrade->benefit }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
