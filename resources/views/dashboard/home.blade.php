@extends('layouts.app')

@section('content')
<style>
    .dashboard-container {
        padding: 2rem;
        font-family: 'Inter', sans-serif;
    }

    .chart-row {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: space-between;
    }

    .chart-card {
        background-color: white;
        padding: 1.5rem;
        border-radius: 1rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        flex: 1;
        min-width: 300px;
        transition: transform 0.2s ease;
    }

    .chart-card:hover {
        transform: translateY(-4px);
    }

    .chart-container {
        height: 300px;
    }

    .statistiek-section {
        margin-top: 3rem;
    }

    .kaart-grid {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
        gap: 1.5rem;
        background-color: #f9fafb;
        padding: 2rem;
        border-radius: 1rem;
    }

    .stat-block {
        flex: 1;
        text-align: center;
        min-width: 200px;
    }

    .stat-block div:first-child {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .stat-block div:last-child {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .select-box {
        margin-top: 1rem;
        padding: 0.5rem;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        font-size: 1rem;
    }

</style>

<div class="dashboard-container">
    <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 2rem;">⚡ Energie Dashboard</h1>

    <!-- Grafieken -->
    <div class="chart-row">
        <div class="chart-card">
            <h2 style="margin-bottom: 1rem;">📊 Verbruik Vandaag (kWh)</h2>
            <div class="chart-container">
                <canvas id="verbruikChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <h2 style="margin-bottom: 1rem;">💶 Kosten Vandaag (€)</h2>
            <div class="chart-container">
                <canvas id="kostenChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <h2 style="margin-bottom: 1rem;">🔄 Live Verbruik</h2>
            <div class="chart-container">
                <canvas id="doelChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Periodeselectie -->
    <div class="statistiek-section">
        <h2 style="font-size: 22px; font-weight: bold;">📆 Inzicht per Periode</h2>
        <select class="select-box" id="periodeSelect">
            <option value="dag">Dag</option>
            <option value="week">Week</option>
            <option value="maand">Maand</option>
        </select>

        <!-- Statistieken -->
        <div id="statistieken" style="margin-top: 2rem;">
            <h3 style="text-align: center; font-weight: bold; margin-bottom: 1rem;">📈 Verbruiksoverzicht</h3>
            <div class="kaart-grid">
                <div class="stat-block">
                    <div>Actief verbruik:</div>
                    <div id="actiefVerbruik">-</div>
                </div>
                <div class="stat-block">
                    <div>Opgeslagen energie:</div>
                    <div id="opgeslagenEnergie">-</div>
                </div>
                <div class="stat-block">
                    <div>Totale verbruik vandaag:</div>
                    <div id="totaalVerbruik">-</div>
                </div>
                <div class="stat-block">
                    <div>Piekverbruik:</div>
                    <div id="piekverbruik">-</div>
                </div>
            </div>
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

    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                labels: {
                    color: '#333',
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            },
            tooltip: {
                backgroundColor: '#fff',
                titleColor: '#111',
                bodyColor: '#111',
                borderColor: '#ccc',
                borderWidth: 1
            }
        },
        scales: {
            x: {
                ticks: {
                    color: '#555',
                    font: { size: 12 },
                    autoSkip: true,
                    maxTicksLimit: 10
                },
                grid: { color: '#eee' }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#555',
                    font: { size: 12 }
                },
                grid: { color: '#eee' }
            }
        },
        elements: {
            point: { radius: 0 },
            line: { tension: 0.4, borderWidth: 2 }
        }
    };

    // Verbruik Chart
    const verbruikCtx = document.getElementById('verbruikChart').getContext('2d');
    const verbruikGradient = verbruikCtx.createLinearGradient(0, 0, 0, 400);
    verbruikGradient.addColorStop(0, 'rgba(76, 175, 80, 0.4)');
    verbruikGradient.addColorStop(1, 'rgba(76, 175, 80, 0)');

    new Chart(verbruikCtx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'kWh',
                data: kwhData,
                borderColor: '#4CAF50',
                backgroundColor: verbruikGradient,
                fill: true
            }]
        },
        options: chartOptions
    });

    // Kosten Chart
    const kostenCtx = document.getElementById('kostenChart').getContext('2d');
    const kostenGradient = kostenCtx.createLinearGradient(0, 0, 0, 400);
    kostenGradient.addColorStop(0, 'rgba(25, 118, 210, 0.4)');
    kostenGradient.addColorStop(1, 'rgba(25, 118, 210, 0)');

    new Chart(kostenCtx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: '€',
                data: kostenData,
                borderColor: '#1976D2',
                backgroundColor: kostenGradient,
                fill: true
            }]
        },
        options: chartOptions
    });

    // Donut Chart (Live verbruik)
    const doelCtx = document.getElementById('doelChart').getContext('2d');
    const doelChart = new Chart(doelCtx, {
        type: 'doughnut',
        data: {
            labels: ['Gebruikt', 'Resterend'],
            datasets: [{
                data: [0, 100],
                backgroundColor: ['#4CAF50', '#E0E0E0']
            }]
        },
        options: {
            responsive: true,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#333',
                        font: { size: 14 }
                    }
                }
            }
        }
    });

    function updateDoelChart() {
        fetch('/api/progress')
            .then(res => res.json())
            .then(data => {
                const gebruikt = data.percentage ?? 0;
                const resterend = 100 - gebruikt;

                doelChart.data.datasets[0].data = [gebruikt, resterend];
                doelChart.update();
            });
    }

    updateDoelChart();
    setInterval(updateDoelChart, 5000);

    // Periode select gedrag
    document.getElementById('periodeSelect').addEventListener('change', function () {
        const periode = this.value;
        fetch(`/inzicht/${periode}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    document.getElementById('statistieken').innerHTML = `<p style="color: red;">${data.error}</p>`;
                    return;
                }

                document.getElementById('actiefVerbruik').textContent = data.actief_verbruik ? `${data.actief_verbruik} W` : '0 W';
                document.getElementById('opgeslagenEnergie').textContent = data.opgeslagen_energie ? `${data.opgeslagen_energie} kWh` : '0 kWh';
                document.getElementById('totaalVerbruik').textContent = data.totaal_verbruik ? `${data.totaal_verbruik} kWh` : '0 kWh';
                document.getElementById('piekverbruik').textContent = data.piekverbruik ? `${data.piekverbruik.tijd} - ${data.piekverbruik.waarde} kWh` : 'Geen piek';
            })
            .catch(error => {
                document.getElementById('statistieken').innerHTML = `<p style="color: red;">Fout bij ophalen data.</p>`;
                console.error(error);
            });
    });

    document.getElementById('periodeSelect').dispatchEvent(new Event('change'));
</script>
@endpush
