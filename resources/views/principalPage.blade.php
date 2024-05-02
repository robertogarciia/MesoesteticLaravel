@extends('master')

@section('content')

<div class="container mt-5">
    <!-- Tarjetas mostrando mejoras por estado -->
    <div class="row">
        <div class="col-sm-4">
            <!-- Asegúrate de usar la clase "card" -->
            <div class="card" style="border: 2px solid black; border-radius: 20px; height: 150px;"> 
                <div class="card-body text-center">
                    <h3 class="card-title">Mejoras en observación</h3>
                    <p class="card-text fs-5">
                        <h2>{{ $countUpgrades['Valorandose'] }}</h2>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="card" style="border: 2px solid black; border-radius: 20px; height: 150px;">
                <div class="card-body text-center">
                    <h3 class="card-title">Mejoras en curso</h3>
                    <p class="card-text fs-5">
                        <h2>{{ $countUpgrades['En_curso'] }}</h2>
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-sm-4">
            <div class="card" style="border: 2px solid black; border-radius: 20px; height: 150px;">
                <div class="card-body text-center">
                    <h3 la clase="card-title">Mejoras completadas</h3>
                    <p la clase="card-text fs-5">
                        <h2>{{ $countUpgrades['Resuelta'] }}</h2>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Gráficos en columnas -->
    <div class="row mt-5">
        <!-- Gráfico de pastel para mostrar porcentajes de mejoras por estado -->
        <div class="col-md-6">
            <div class="container" style="border: 2px solid negro; border-radius: 30px; padding: 15px;">
                <canvas id="tascasChart" width="300" height="300"></canvas>
            </div>
        </div>

        <!-- Gráfico para el tiempo promedio de cambios de estado -->
        <div class="col-md-6">
            <div class="container" style="border: 2px solid negro; border-radius: 30px; padding: 15px;">
                <canvas id="avgStateChangeTimeChart" width="300" height="300"></canvas>
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
                    text: 'Distribución de Mejoras por Estado'
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
