@extends('master')

@section('content')

<div class="container mt-5">
    <!-- Tarjetas mostrando mejoras por estado -->
    <div class="row">
        <div class="col-sm-4">
            <div class="card shadow-sm" style="border-radius: 20px; height: 150px;">
                <div class="card-body text-center">
                    <h3 class="card-title">Millores en observació</h3>
                    <p class="card-text fs-5">
                        <h2>{{ $countUpgrades['Valorandose'] }}</h2>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow-sm" style="border-radius: 20px; height: 150px;">
                <div class="card-body text-center">
                    <h3 class="card-title">Millores en curs</h3>
                    <p class="card-text fs-5">
                        <h2>{{ $countUpgrades['En_curso'] }}</h2>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow-sm" style="border-radius: 20px; height: 150px;">
                <div class="card-body text-center">
                    <h3 class="card-title">Millores completades</h3>
                    <p class="card-text fs-5">
                        <h2>{{ $countUpgrades['Resuelta'] }}</h2>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Espacio entre tarjetas y gráficos -->
    <div class="my-5"></div>

    <!-- Gráfico de pastel para mostrar porcentajes de mejoras por estado -->
    <div class="container" style="max-width: 400px; border: 2px solid black; border-radius: 30px; padding-bottom: 15px;">
        <div class="row">
            <div class="col-12 text-center">
                <canvas id="tascasChart" width="300" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Script para inicializar el gráfico -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Datos para el gráfico de mejoras por estado
    const dataTascas = {
        labels: ['Valorándose', 'En curso', 'Resuelta'],
        datasets: [{
            data: [{{ $percentages['Valorandose'] }}, {{ $percentages['En_Curso'] }}, {{ $percentages['Resuelta'] }}],
            backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384'],
        }]
    };

    const configTascas = {
        type: 'doughnut',
        data: dataTascas,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Distribución de Tascas por Estado'
                }
            }
        }
    };

    const ctxTascas = document.getElementById('tascasChart').getContext('2d');
    const myChartTascas = new Chart(ctxTascas, configTascas);
</script>

<!-- Gráfico de historial de cambios de estado -->
<div class="container mt-5">
    <h3>Historial de Cambios de Estado de las Mejoras</h3>
    <canvas id="stateChangesChart"></canvas>
</div>

<!-- Script para inicializar el gráfico de historial -->
<script>
    const dataStateChanges = {
        labels: ['Valorándose', 'En curso', 'Resuelta'],
        datasets: [{
            data: [{{ $stateChangeCounts['Valorandose'] }}, {{ $stateChangeCounts['En_curso'] }}, {{ $stateChangeCounts['Resuelta'] }}],
            backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384'],
        }]
    };

    const configStateChanges = {
        type: 'doughnut',
        data: dataStateChanges,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Historial de Cambios de Estado de las Mejoras'
                }
            }
        }
    };

    const ctxStateChanges = document.getElementById('stateChangesChart').getContext('2d');
    const myChartStateChanges = new Chart(ctxStateChanges, configStateChanges);
</script>

@endsection
