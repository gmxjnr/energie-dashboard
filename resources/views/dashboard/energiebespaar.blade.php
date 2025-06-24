@extends('layouts.app')

@section('content')
    <h2>Energiebespaar Tips</h2>
    <ul>
        <li>Zet apparaten volledig uit in plaats van op stand-by.</li>
        <li>Gebruik energiezuinige LED-lampen.</li>
        <li>Verlaag je thermostaat 1 graad voor besparing.</li>
    </ul>
@endsection
 
@extends('layouts.app')
 
@section('content')

<!-- Voeg deze grafiek toe waar je wilt - bijvoorbeeld onderaan -->
<div class="card shadow-sm mt-5">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Energieverbruik Overzicht</h5>
    </div>
    <div class="card-body">
        <div class="chart-container" style="position: relative; height: 400px;">
            <canvas id="energyChart"></canvas>
        </div>
    </div>
</div>

<!-- Voeg deze scripts toe aan het einde van het bestand -->
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Eenvoudige voorbeelddata - vervang met echte data
        const energyChart = new Chart(
            document.getElementById('energyChart'),
            {
                type: 'bar',
                data: {
                    labels: ['Januari', 'Februari', 'Maart', 'April'],
                    datasets: [{
                        label: 'Verbruik (kWh)',
                        data: [320, 290, 300, 250],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(75, 192, 192, 0.7)',
                            'rgba(255, 206, 86, 0.7)'
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' kWh';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value + ' kWh';
                                }
                            }
                        }
                    }
                }
            }
        );
    });
</script>
@endsection
@endsection 