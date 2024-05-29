
<!-- Script per inicialitzar els gràfics -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctxTascas = document.getElementById('tascasChart').getContext('2d');
    const myChartTascas = new Chart(ctxTascas, {
        type: 'doughnut',
        data: {
            labels: ['Valorandose', 'En curso', 'Resueltas'],
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
            labels: ['Valorandose', 'En curso', 'Resueltas'],
            datasets: [{
                label: 'Tiempo promedio (días)',
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
                    text: 'Tiempo promedio para cambiar de estado (días)',
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
                label: 'Mejoras resueltas',
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
                    text: 'Tendencia de mejoras resueltas por mes',
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