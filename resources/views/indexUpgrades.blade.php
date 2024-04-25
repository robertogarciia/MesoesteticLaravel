@extends('master')

@section('content')
<div class="container">
  <h2 class="my-4 text-center">Our Latest Upgrades</h2>

  <div class="row">
    @foreach($upgrades as $upgrade)
      <div class="col-md-6 mb-4">
        <div class="card border-0 shadow h-100 d-flex flex-column">
          <img src="{{ $upgrade->image }}" class="card-img-top" alt="{{ $upgrade->name }}">
          <div class="card-body d-flex flex-grow-1 justify-content-between align-items-end">
            <div>
              <h5 class="card-title">{{ $upgrade->title }}</h5>
              <p class="card-text">{{ $upgrade->zone }}</p>
              <p class="card-text text-truncate">{{ Str::limit($upgrade->description, 150) }}</p>
            </div>
            <a href="{{ route('upgrades.show', $upgrade->id) }}" class="btn btn-primary">Learn More</a>
          </div>
        </div>
      </div>

      @if ($loop->iteration % 2 == 0) </div>
        <div class="row">
      @endif

    @endforeach
  </div>
</div>
@endsection

