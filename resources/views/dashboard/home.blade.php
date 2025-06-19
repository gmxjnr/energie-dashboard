@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 2rem;">Energie Dashboard</h1>

    <!-- Grafieken naast elkaar -->
    <div class="chart-row" style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: space-between;">
        <!-- Verbruik -->
        <div class="chart-card" style="flex: 1; min-width: 300px;">
            <h2 style="margin-bottom: 1rem;">Verbruik Vandaag (kWh)</h2>
            <div class="chart-container" style="height: 300px;">
                <canvas id="verbruikChart"></canvas>
            </div>
        </div>

        <!-- Kosten -->
        <div class="chart-card" style="flex: 1; min-width: 300px;">
            <h2 style="margin-bottom: 1rem;">Kosten Vandaag (€)</h2>
            <div class="chart-container" style="height: 300px;">
                <canvas id="kostenChart"></canvas>
            </div>
        </div>

        <!-- Doel -->
        <div class="chart-card" style="flex: 1; min-width: 300px;">
            <h2 style="margin-bottom: 1rem;">Live Verbuik</h2>
            <div class="chart-container" style="height: 300px;">
                <canvas id="doelChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Statistieken Periode -->
    <div class="statistiek-section" style="margin-top: 3rem;">
        <h2 style="font-size: 20px; font-weight: bold; margin-bottom: 1rem;">Inzicht per periode</h2>
        <select class="select-box" id="periodeSelect" style="padding: 0.5rem; border-radius: 4px; border: 1px solid #ccc;">
            <option value="dag">Dag</option>
            <option value="week">Week</option>
            <option value="maand">Maand</option>
        </select>

        <!-- Verbruiksoverzicht -->
        <div id="statistieken" style="margin-top: 2rem;">
            <h3 style="text-align: center; margin-bottom: 1rem; font-weight: bold;">Verbruiksoverzicht</h3>
            <div style="display: flex; justify-content: space-around; flex-wrap: wrap; background-color: #f8fafc; padding: 1.5rem; border-radius: 8px;">
                <div style="text-align: center; flex: 1;">
                    <div style="font-weight: 600;">Actief verbruik:</div>
                    <div id="actiefVerbruik" style="font-size: 1.25rem;">-</div>
                </div>
                <div style="text-align: center; flex: 1;">
                    <div style="font-weight: 600;">Opgeslagen energie:</div>
                    <div id="opgeslagenEnergie" style="font-size: 1.25rem;">-</div>
                </div>
                <div style="text-align: center; flex: 1;">
                    <div style="font-weight: 600;">Totale verbruik vandaag:</div>
                    <div id="totaalVerbruik" style="font-size: 1.25rem;">-</div>
                </div>
                <div style="text-align: center; flex: 1;">
                    <div style="font-weight: 600;">Piekverbruik:</div>
                    <div id="piekverbruik" style="font-size: 1.25rem;">-</div>
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
                    font: {
                        size: 12
                    },
                    autoSkip: true,
                    maxTicksLimit: 10
                },
                grid: {
                    color: '#eee'
                }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    color: '#555',
                    font: {
                        size: 12
                    }
                },
                grid: {
                    color: '#eee'
                }
            }
        },
        elements: {
            point: {
                radius: 0
            },
            line: {
                tension: 0.4,
                borderWidth: 2
            }
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

    // === LIVE Donut Chart Update ===
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
                        font: {
                            size: 14
                        }
                    }
                }
            }
        }
    });

    function updateDoelChart() {
        fetch('/api/progress')
            .then(res => res.json())
            .then(data => {
                const gebruikt = data.percentage;
                const resterend = 100 - gebruikt;

                doelChart.data.datasets[0].data = [gebruikt, resterend];
                doelChart.update();
            });
    }

    // Initieel en vervolgens elke 5 seconden
    updateDoelChart();
    setInterval(updateDoelChart, 500);

    // Periode select
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

    // Initieel laden
    document.getElementById('periodeSelect').dispatchEvent(new Event('change'));
</script>
@endpush
