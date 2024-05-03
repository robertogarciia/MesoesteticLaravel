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
                    <h4 class="card-title">Millores a valorar </h4>
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
                    <h4 class="card-title">Millores en curs</h4>
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
                    <h4 class="card-title">Millores Resoltes</h4>
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

</div>

<!-- Script para inicializar los gráficos -->
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
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Distribución por Estado',
                },
            },
        },
    });

    const ctxAvgStateChangeTime = document.getElementById('avgStateChangeTimeChart').getContext('2d');
    const avgStateChangeTimeChart = new Chart(ctxAvgStateChangeTime, {
        type: 'bar',
        data: {
            labels: ['Valorándose', 'En curso', 'Resuelta'],
            datasets: [{
                label: 'Tiempo Promedio (días)',
                data: [
                    {{ $upgradeTimes['Valorándose'] ?? 0 }},
                    {{ $upgradeTimes['En_curso'] ?? 0 }},
                    {{ $upgradeTimes['Resuelta'] ?? 0 }},
                ],
                backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384'],
            }],
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Tiempo Promedio de Cambios de Estado (en días)',
                },
            },
        },
    });

    const ctxMonthlyTrends = document.getElementById('monthlyTrendsChart').getContext('2d');
    const monthlyTrendsChart = new Chart(ctxMonthlyTrends, {
        type: 'line', // Gráfico de líneas
        data: {
            labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'], // Etiquetas para el eje x
            datasets: [{
                label: 'Mejoras Resueltas',
                data: [
                    {{ $monthlyData['Enero'] ?? 0 }},
                    {{ $monthlyData['Febrero'] ?? 0 }},
                    {{ $monthlyData['Marzo'] ?? 0 }},
                    {{ $monthlyData['Abril'] ?? 0 }},
                    {{ $monthlyData['Mayo'] ?? 0 }},
                    {{ $monthlyData['Junio'] ?? 0 }},
                    {{ $monthlyData['Julio'] ?? 0 }},
                    {{ $monthlyData['Agosto'] ?? 0 }},
                    {{ $monthlyData['Septiembre'] ?? 0 }},
                    {{ $monthlyData['Octubre'] ?? 0 }},
                    {{ $monthlyData['Noviembre'] ?? 0 }},
                    {{ $monthlyData['Diciembre'] ?? 0 }},
                ],
                borderColor: '#36a2eb', // Color de la línea
                fill: false, // No rellenar debajo de la línea
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                },
                title: {
                    display: true,
                    text: 'Mejoras Resueltas por Mes',
                },
            },
        },
    });
</script>

@endsection
