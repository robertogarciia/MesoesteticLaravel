@extends('master')

@section('content')

<div class="container mt-5">
    <!-- Tarjetas mostrando mejoras por estado -->
    <div class="row">
        <!-- Tarjeta para mejoras en observación -->
        <div class="col-sm-4">
            <div class="card shadow-sm" style="border: 2px solid #000000; border-radius: 15px; height: 150px;background: rgb(228,228,228);
background: linear-gradient(360deg, rgba(228,228,228,1) 0%, rgba(235,54,58,1) 100%); ">
                <div class="card-body text-center">

                    <h4 class="card-title">Mejoras </h4>

                    <p class="card-text" style="font-size: 2em; font-weight: bold;">
                        {{ $countUpgrades['Valorandose'] }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Tarjeta para mejoras en curso -->
        <div class="col-sm-4">
            <div class="card shadow-sm" style="border: 2px solid #000000; border-radius: 15px; height: 150px;background: rgb(228,228,228);
background: linear-gradient(360deg, rgba(228,228,228,1) 0%, rgba(255,205,86,1) 100%);">
                <div class="card-body text-center">
                    <h4 class="card-title">Mejoras en curso</h4>
                    <p class="card-text" style="font-size: 2em; font-weight: bold;">
                        {{ $countUpgrades['En_curso'] }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Tarjeta para mejoras completadas -->
        <div class="col-sm-4">
            <div class="card shadow-sm" style="border: 2px solid #000000; border-radius: 15px; height: 150px; background: rgb(228,228,228);
background: linear-gradient(360deg, rgba(228,228,228,1) 0%, rgba(54,162,235,1) 100%);">
                <div class="card-body text-center">
                    <h4 class="card-title">Mejoras resueltas</h4>
                    <p class="card-text" style="font-size: 2em; font-weight: bold;">
                        {{ $countUpgrades['Resuelta'] }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficas en una fila -->
    <div class="row mt-4">
        <!-- Gráfico de pastel para porcentajes de mejoras por estado -->
        <div class="col-md-6">
            <div class="card shadow-sm" style="border-radius: 15px; border: 1px solid #ddd; padding: 20px;">
                <div class="card-body text-center">
                    <h5>Distribución por Estado</h5>
                    <canvas id="tascasChart" width="200" height="180"></canvas> <!-- Ajustar tamaño -->
                </div>

            </div>
        </div>

        <!-- Gráfico para el tiempo promedio de cambios de estado -->
        <div class="col-md-6">
            <div class="card shadow-sm" style="border-radius: 15px; border: 1px solid #ddd; padding: 20px;">
                <div class="card-body text-center">
                    <h5>Tiempo Promedio para Cambiar de Estado</h5>
                    <canvas id="avgStateChangeTimeChart" width="200" height="180"></canvas> <!-- Ajustar tamaño -->
                </div>
            </div>
        </div>


        <!-- Gráfico para el tiempo promedio de cambios de estado -->
        <div class="col-md-6">
            <div class="card shadow-sm" style="border-radius: 15px; border: 1px solid #ddd; padding: 20px;">
                <div class="card-body text-center">
                    <h5>Tiempo Promedio para Cambiar de Estado</h5>
                    <canvas id="avgStateChangeTimeChart" width="200" height="180"></canvas> <!-- Ajustar tamaño -->

    <!-- Tabla de usuarios con más upgrades -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 15px; border: 1px solid #ddd; padding: 20px;">
                <div class="card-body text-center">
                    <h5>Usuaris amb més Upgrades</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Usuari</th>
                                <th>Nombre d'Upgrades</th>
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


    <!-- Tendencia de Mejoras Resueltas por Mes -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 15px; border: 1px solid #ddd; padding: 20px;">
                <div class="card-body text-center">
                    <h5>Tendencia de Mejoras Resueltas por Mes</h5>
                    <canvas id="monthlyTrendsChart" width="1100" height="200"></canvas>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Script para inicializar los gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctxTascas = document.getElementById('tascasChart').getContext('2d');
    const myChartTascas = new Chart(ctxTascas, {
        type: 'doughnut',
        data: {
            labels: ['Valorandose', 'En curso', 'Resuelta'],
            datasets: [{
                data: [
                    {{ $percentages['Valorandose'] }},
                    {{ $percentages['En_Curso'] }},
                    {{ $percentages['Resuelta'] }},
                ],
                backgroundColor: ['#eb363a', '#ffcd56', '#36a2eb'],
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                },
            },
        },
    });

    const ctxAvgStateChangeTime = document.getElementById('avgStateChangeTimeChart').getContext('2d');
    const avgStateChangeTimeChart = new Chart(ctxAvgStateChangeTime, {
        type: 'bar',
        data: {

            labels: ['Valorandose', 'En curso', 'Resuelta'],
            datasets: [{
                label: 'Tiempo Promedio (días)',
                data: [
                    {{ $upgradeTimes['Valorandose'] ?? 0 }},
                    {{ $upgradeTimes['En curso'] ?? 0 }},
                    {{ $upgradeTimes['Resuelta'] ?? 0 }},
                ],
                backgroundColor: ['#eb363a', '#ffcd56', '#36a2eb'],

            }],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,

                    text: 'Tiempo Promedio para Cambiar de Estado (días)',

                },
            },
        },
    });

    const ctxMonthlyTrends = document.getElementById('monthlyTrendsChart').getContext('2d');
    const monthlyTrendsChart = new Chart(ctxMonthlyTrends, {
        type: 'line',
        data: {

            labels: {!! json_encode(array_keys($monthlyData['Valorandose'])) !!},
            datasets: [{
                label: 'Valorandose',
                data: {!! json_encode(array_values($monthlyData['Valorandose'])) !!},
                borderColor: '#eb363a',
                fill: false,
            }, {
                label: 'En curso',
                data: {!! json_encode(array_values($monthlyData['En_curso'])) !!},
                borderColor: '#ffcd56',
                fill: false,
            }, {
                label: 'Resuelta',
                data: {!! json_encode(array_values($monthlyData['Resuelta'])) !!},
                borderColor: '#36a2eb',
                fill: false,

            }],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            plugins: {
                legend: {

                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Tendencia de Mejoras por Mes',

                },
            },
        },
    });
</script>

@endsection
