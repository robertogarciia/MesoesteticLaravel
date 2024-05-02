@extends('master')
@section('content')

<body>
    <main>
    <div class="container mt-5">
            <form class="row" method='POST' action="{{ route('upgrades.update', ['upgrade'=>$upgrade]) }}">
            @csrf
            @method('PUT')
            <div class="col-md-6 Z mt-3">
            <input type="hidden" name="upgrade_id" value="{{ $upgrade->id }}">

                <div class="mb-3">
                    <label for="state" class="form-label">Estat</label>
                    <select class="form-control" id="state" name="state">
                        <option value="Valorandose" {{ $upgrade->state == 'Valorandose' ? 'selected' : '' }}>Valorandose</option>
                        <option value="En curso" {{ $upgrade->state == 'En curso' ? 'selected' : '' }}>En curso</option>
                        <option value="Resuelta" {{ $upgrade->state == 'Resuelta' ? 'selected' : '' }}>Resuelta</option>
                    </select>
                </div>
            
            <button type="submit" class="btn btn-primary">Desar canvis</button>
            </form>
        </div>
    </main>
    <footer>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
@endsection
