@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 2rem;">Analyse</h1>

    <div class="chart-row">
        <div class="chart-card small-card">
            <h2 style="margin-bottom: 1rem;">Conversions</h2>
            <div class="chart-container"><canvas id="conversionsChart"></canvas></div>
        </div>

        <div class="chart-card wide-card">
            <h2 style="margin-bottom: 1rem;">Last 30 days</h2>
            <div class="chart-container"><canvas id="last30Chart"></canvas></div>
        </div>

        <div class="chart-card wide-card">
            <h2 style="margin-bottom: 1rem;">Production</h2>
            <div class="chart-container"><canvas id="productionChart"></canvas></div>
        </div>
    </div>

    <div class="chart-row">
        <div class="chart-card small-card">
            <h2 style="margin-bottom: 1rem;">Users</h2>
            <div class="chart-container"><canvas id="usersChart"></canvas></div>
        </div>

        <div class="chart-card wide-card">
            <h2 style="margin-bottom: 1rem;">Energy intensity</h2>
            <div class="chart-container"><canvas id="intensityChart"></canvas></div>
        </div>

        <div class="chart-card small-card">
            <h2 style="margin-bottom: 1rem;">Usage estimated</h2>
            <div class="chart-container"><canvas id="usageChart"></canvas></div>
        </div>

        <div class="chart-card small-card">
            <h2 style="margin-bottom: 1rem;">Sales</h2>
            <div class="chart-container"><canvas id="salesChart"></canvas></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chartsConfig = [
            {
                id: 'conversionsChart', label: 'Conversions', data: [5, 8, 6, 7, 9, 10, 4],
                labels: ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'], color: '#FF5722'
            },
            {
                id: 'last30Chart', label: 'Last 30 days', data: [20, 18, 25, 22, 30, 24, 28],
                labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5', 'Week 6', 'Week 7'], color: '#4CAF50'
            },
            {
                id: 'productionChart', label: 'Production', data: [10, 12, 14, 13, 11, 15, 16],
                labels: ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'], color: '#2196F3'
            },
            {
                id: 'usersChart', label: 'Users', data: [2, 3, 4, 3, 5, 6, 5],
                labels: ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'], color: '#9C27B0'
            },
            {
                id: 'intensityChart', label: 'Energy Intensity', data: [100, 95, 90, 110, 105, 108, 102],
                labels: ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'], color: '#FFC107'
            },
            {
                id: 'usageChart', label: 'Usage Estimated', data: [60, 62, 58, 65, 64, 66, 63],
                labels: ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'], color: '#00BCD4'
            },
            {
                id: 'salesChart', label: 'Sales', data: [30, 35, 33, 36, 32, 31, 34],
                labels: ['Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za', 'Zo'], color: '#8BC34A'
            }
        ];

        function createLineChart(id, label, data, labels, color) {
            const ctx = document.getElementById(id);
            if (!ctx) return;

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        borderColor: color,
                        backgroundColor: color + '33',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: { ticks: { autoSkip: true, maxTicksLimit: 10 } }
                    }
                }
            });
        }

        chartsConfig.forEach(chart => {
            createLineChart(chart.id, chart.label, chart.data, chart.labels, chart.color);
        });
    });
</script>
@endpush
