@extends('layouts.app')

@section('content')
    <!-- Sectie 1: Tips -->
    <section class="mb-5">
        <h2>Energiebespaar Tips</h2>
        <ul>
            <li>Zet apparaten volledig uit in plaats van op stand-by.</li>
            <li>Gebruik energiezuinige LED-lampen.</li>
            <li>Verlaag je thermostaat 1 graad voor besparing.</li>
        </ul>
    </section>

    <!-- Sectie 2: Staafdiagram -->
    <section class="mb-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Energieverbruik Overzicht</h5>
            </div>
            <div class="card-body">
                <div class="chart-container" style="position: relative; height: 400px;">
                    <canvas id="energyChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <!-- Sectie 3: Cirkeldiagram -->
    <section class="mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Verdeling Energieverbruik</h5>
            </div>
            <div class="card-body">
                <div class="chart-container" style="position: relative; height: 400px;">
                    <canvas id="usagePieChart"></canvas>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Staafdiagram
        const ctx = document.getElementById('energyChart');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Januari', 'Februari', 'Maart', 'April'],
                    datasets: [{
                        label: 'Verbruik (kWh)',
                        data: [320, 290, 300, 250],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.7)'
                            
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)'
                            
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#1e3a8a',
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });
        }

        // Cirkeldiagram
        const usagePieChartElement = document.getElementById('usagePieChart');
        if (usagePieChartElement) {
            new Chart(usagePieChartElement, {
                type: 'doughnut',
                data: {
                    labels: ['Verwarming', 'Elektronica', 'Verlichting'],
                    datasets: [{
                        data: [45, 35, 20],
                        backgroundColor: [
                            'rgba(75, 192, 75, 0.7)',   // groen
                             'rgb(150, 24, 24)', 
                            'rgba(255, 206, 86, 0.7)'   // geel
                        ],
                        borderColor: [
                            'rgba(75, 192, 75, 1)',
                            'rgb(150, 24, 24)',
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
                            position: 'bottom',
                            labels: {
                                color: '#1e3a8a',
                                font: {
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush
 