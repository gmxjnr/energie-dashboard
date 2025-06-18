@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 2rem;">Energie Dashboard</h1>

    <!-- Grafieken naast elkaar -->
    <div class="chart-row">
        <!-- Verbruik -->
        <div class="chart-card">
            <h2 style="margin-bottom: 1rem;">Verbruik Vandaag (kWh)</h2>
            <div class="chart-container">
                <canvas id="verbruikChart"></canvas>
            </div>
        </div>

        <!-- Kosten -->
        <div class="chart-card">
            <h2 style="margin-bottom: 1rem;">Kosten Vandaag (€)</h2>
            <div class="chart-container">
                <canvas id="kostenChart"></canvas>
            </div>
        </div>

        <!-- Doel -->
        <div class="chart-card">
            <h2 style="margin-bottom: 1rem;">Doel Deze Week</h2>
            <div class="chart-container">
                <canvas id="doelChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Statistieken Periode -->
    <div class="statistiek-section">
        <h2 style="font-size: 20px; font-weight: bold; margin-bottom: 1rem;">Inzicht per periode</h2>
        <select class="select-box" id="periodeSelect">
            <option value="dag">Dag</option>
            <option value="week">Week</option>
            <option value="maand">Maand</option>
        </select>
        <div id="statistieken" style="margin-top: 1rem;">
            <p>(Statistieken komen in deel 2)</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($labels);
    const kwhData = @json($kwhData);
    const kostenData = @json($kostenData);
    const doelPercentage = @json($doelPercentage);

    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                ticks: {
                    autoSkip: true,
                    maxTicksLimit: 10
                }
            }
        }
    };

    new Chart(document.getElementById('verbruikChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'kWh',
                data: kwhData,
                borderColor: '#4CAF50',
                backgroundColor: 'rgba(76, 175, 80, 0.1)',
                tension: 0.4
            }]
        },
        options: chartOptions
    });

    new Chart(document.getElementById('kostenChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: '€',
                data: kostenData,
                borderColor: '#1976D2',
                backgroundColor: 'rgba(25, 118, 210, 0.1)',
                tension: 0.4
            }]
        },
        options: chartOptions
    });

    new Chart(document.getElementById('doelChart'), {
        type: 'doughnut',
        data: {
            labels: ['Gebruikt', 'Resterend'],
            datasets: [{
                data: [doelPercentage, 100 - doelPercentage],
                backgroundColor: ['#4CAF50', '#E0E0E0']
            }]
        },
        options: {
            ...chartOptions,
            cutout: '70%'
        }
    });
</script>
@endpush
