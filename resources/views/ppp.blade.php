@extends('master')

@section('content')

@foreach($upgrades as $upgrade)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $upgrade->name }}</h5>
            <p class="card-text">{{ $upgrade->description }}</p>
           
        </div>
    </div>
@endforeach

@endsection
