@extends('master')

@section('content')

<div class="container mt-5">
    <!-- Targetes mostrant millores per estat -->
    <div class="row">
        <!-- Targeta per a millores en observació -->
        <div class="col-sm-4">
            <div class="card shadow-sm" style="border: 2px solid #000000; border-radius: 15px; height: 150px; background: rgb(228,228,228); background: linear-gradient(360deg, rgba(228,228,228,1) 0%, rgba(235,54,58,1) 100%);">
                <div class="card-body text-center">
                    <h4 class="card-title">Millores a valorar</h4>
                    <p class="card-text" style="font-size: 2em; font-weight: bold;">
                        {{ $countUpgrades['Valorandose'] }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Targeta per a millores en curs -->
        <div class="col-sm-4">
            <div class="card shadow-sm" style="border: 2px solid #000000; border-radius: 15px; height: 150px; background: rgb(228,228,228); background: linear-gradient(360deg, rgba(228,228,228,1) 0%, rgba(255,205,86,1) 100%);">
                <div class="card-body text-center">
                    <h4 class="card-title">Millores en curs</h4>
                    <p class="card-text" style="font-size: 2em; font-weight: bold;">
                        {{ $countUpgrades['En_curso'] }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Targeta per a millores completades -->
        <div class="col-sm-4">
            <div class="card shadow-sm" style="border: 2px solid #000000; border-radius: 15px; height: 150px; background: rgb(228,228,228); background: linear-gradient(360deg, rgba(228,228,228,1) 0%, rgba(54,162,235,1) 100%);">
                <div class="card-body text-center">
                    <h4 class="card-title">Millores Resoltes</h4>
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
                    <h5>Distribució per Estat</h5>
                    <canvas id="tascasChart" width="200" height="180"></canvas> <!-- Ajustar mida -->
                </div>
            </div>
        </div>

        <!-- Gràfic per al temps promig de canvis d'estat -->
        <div class="col-md-6">
            <div class="card shadow-sm" style="border-radius: 15px; border: 1px solid #ddd; padding: 20px;">
                <div class="card-body text-center">
                    <h5>Temps Promig per Canviar d'Estat</h5>
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
    </div>

    <!-- Tendència de Millores Resoltes per Mes -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 15px; border: 1px solid #ddd; padding: 20px;">
                <div class="card-body text-center">
                    <h5>Tendència de Millores Resoltes per Mes</h5>
                    <canvas id="monthlyTrendsChart" width="1100" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Script per inicialitzar els gràfics -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctxTascas = document.getElementById('tascasChart').getContext('2d');
    const myChartTascas = new Chart(ctxTascas, {
        type: 'doughnut',
        data: {
            labels: ['Valorant-se', 'En curs', 'Resoltes'],
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
            labels: ['Observació', 'En curs', 'Resoltes'],
            datasets: [{
                label: 'Temps Promig (dies)',
                data: [3, 7, 2], // Ajustar segons les dades reals
                backgroundColor: ['#eb363a', '#ffcd56', '#36a2eb'],
                borderColor: ['#eb363a', '#ffcd56', '#36a2eb'],
                borderWidth: 1,
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: 'Temps Promig per Canviar d\'Estat',
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });

    const ctxMonthlyTrends = document.getElementById('monthlyTrendsChart').getContext('2d');
    const monthlyTrendsChart = new Chart(ctxMonthlyTrends, {
        type: 'line',
        data: {
            labels: @json($monthLabels),
            datasets: [{
                label: 'Millores Resoltes',
                data: @json($monthlyCounts),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: true,
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },
                title: {
                    display: true,
                    text: 'Tendència de Millores Resoltes per Mes',
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>

@endsection