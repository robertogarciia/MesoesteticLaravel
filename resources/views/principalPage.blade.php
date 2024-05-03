@extends('master')

@section('content')

<div class="container mt-5">
    <!-- Tarjetas mostrando mejoras por estado -->
    <div class="row">
        <!-- Tarjeta para mejoras en observación -->
        <div class="col-sm-4">
            <div class="card shadow-sm" style="border: 1px solid #ddd; border-radius: 15px; height: 150px;">
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
            <div class="card shadow-sm" style="border: 1px solid #ddd; border-radius: 15px; height: 150px;">
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
            <div class="card shadow-sm" style="border: 1px solid #ddd; border-radius: 15px; height: 150px;">
                <div class="card-body text-center">
                    <h4 class="card-title">Mejoras completadas</h4>
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
</div>

</div>

<!-- Script para inicializar los gráficos -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctxTascas = document.getElementById('tascasChart').getContext('2d');
    const myChartTascas = new Chart(ctxTascas, {
        type: 'doughnut',
        data: {
            labels: ['Valorándose', 'En curso', 'Resuelta'],
            datasets: [{
                data: [
                    {{ $percentages['Valorandose'] }},
                    {{ $percentages['En_Curso'] }},
                    {{ $percentages['Resuelta'] }},
                ],
                backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384'],
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
</script>

@endsection
