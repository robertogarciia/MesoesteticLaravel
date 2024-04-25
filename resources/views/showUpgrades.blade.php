@extends('master')

@section('content')
    
<div class="container mt-2 bg-modul p-4">
    <div class="d-flex justify-content-between align-items-center my-4">
        <h2>Dades de la millores</h2>
        <a href="{{ route('upgrades.index') }}" class="btn btn-secondary">Volver Atrás</a>
    </div>
    <div class="row">
        <div class="col">
            <div class="details">
                <div class="row">
                    <div class="col">
                        <div class="details">
                            <strong>Titulo:</strong>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
