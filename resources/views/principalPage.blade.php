@extends('master')

@section('content')

<div class="container mt-5">
    <!-- Targetes mostrant millores per estat -->
    <div class="row">
        <!-- Targeta per a millores en observació -->
        <div class="col-sm-4">
            <div class="card shadow-sm"
                style="border: 2px solid #000000; border-radius: 15px; height: 150px; background: rgb(228,228,228); background: linear-gradient(360deg, rgba(228,228,228,1) 0%, rgba(235,54,58,1) 100%);">
                <div class="card-body text-center">
                    <h4 class="card-title">Mejoras a valorar</h4>
                    <p class="card-text" style="font-size: 2em; font-weight: bold;">
                        {{ $countUpgrades['Valorandose'] }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Targeta per a millores en curs -->
        <div class="col-sm-4">
            <div class="card shadow-sm"
                style="border: 2px solid #000000; border-radius: 15px; height: 150px; background: rgb(228,228,228); background: linear-gradient(360deg, rgba(228,228,228,1) 0%, rgba(255,205,86,1) 100%);">
                <div class="card-body text-center">
                    <h4 class="card-title">Mejoras en curso</h4>
                    <p class="card-text" style="font-size: 2em; font-weight: bold;">
                        {{ $countUpgrades['En_curso'] }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Targeta per a millores completades -->
        <div class="col-sm-4">
            <div class="card shadow-sm"
                style="border: 2px solid #000000; border-radius: 15px; height: 150px; background: rgb(228,228,228); background: linear-gradient(360deg, rgba(228,228,228,1) 0%, rgba(54,162,235,1) 100%);">
                <div class="card-body text-center">
                    <h4 class="card-title">Mejoras resueltas</h4>
                    <p class="card-text" style="font-size: 2em; font-weight: bold;">
                        {{ $countUpgrades['Resuelta'] }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gràfics en una fila -->
    <div class="row mt-4">
        <!-- Gràfic de pastís per a percentatges de millores per estat -->
        <div class="col-md-6">
            <div class="card shadow-sm" style="border-radius: 15px; border: 1px solid #ddd; padding: 20px;">
                <div class="card-body text-center">
                    <h5>Distribución por estado</h5>
                    <canvas id="tascasChart" width="200" height="180"></canvas> <!-- Ajustar mida -->
                </div>
            </div>
        </div>

        <!-- Gràfic per al temps promig de canvis d'estat -->
        <div class="col-md-6">
            <div class="card shadow-sm" style="border-radius: 15px; border: 1px solid #ddd; padding: 20px;">
                <div class="card-body text-center">
                    <h5>Tiempo promedio para cambiar de estado</h5>
                    <canvas id="avgStateChangeTimeChart" width="200" height="180"></canvas> <!-- Ajustar mida -->
                </div>
            </div>
        </div>
    </div>

    <!-- Taula d'usuaris amb més upgrades -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 15px; border: 1px solid #ddd; padding: 20px;">
                <div class="card-body text-center">
                    <h5>Usuarios con mas mejoras creadas</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Numero de mejoras</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userUpgrades as $user)
                            <tr>
                                <td>{{ $user->name }} {{ $user->surname }}</td>
                                <td>{{ $user->upgrades_count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tendència de Millores Resoltes per Mes -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 15px; border: 1px solid #ddd; padding: 20px;">
                <div class="card-body text-center">
                    <h5>Tendencia de mejoras resueltas por mes</h5>
                    <canvas id="monthlyTrendsChart" width="1100" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

@include('charts')
@endsection