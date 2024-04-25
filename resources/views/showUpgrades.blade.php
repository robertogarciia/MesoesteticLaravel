@extends('master')

@section('content')


<div class="container">
    <h2 class="my-4 text-center">Llista de millores</h2>

    <div class="row">
        
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow h-100 d-flex flex-column">
               
                <div class="card-body d-flex flex-grow-1 justify-content-between align-items-stretch">
                    <div class="d-flex flex-column">
                        <div>
                            <h5 class="card-title
                           
                            ">{{$Upgrade->title}}</h5>
                            <p class="card-text"><b>Estado:</b> {{$Upgrade->state}}</p>
                            <p class="card-text"><b>Likes:</b> {{$Upgrade->likes}}</p>
                            <p class="card-text"><b>Zona:</b> {{ $Upgrade->zone }}</p>

                        @if ($Upgrade->state === 'Valorandose')
                            <a href="{{ route('upgrades.edit', $Upgrade->id) }}" class="btn btn-primary btn-sm">Edit Upgrade</a>
                        @endif
                </div>


                           

        


@endsection