@extends('layouts.app')

@section('content')
    <h2>Energiebespaar Tips</h2>
    <ul>
        <li>Zet apparaten volledig uit in plaats van op stand-by.</li>
        <li>Gebruik energiezuinige LED-lampen.</li>
        <li>Verlaag je thermostaat 1 graad voor besparing.</li>
    </ul>

    <!-- Energieverbruik Overzicht (balkgrafiek) -->
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

    <!-- Campagneverdeling (cirkelgrafiek) -->
    <div class="card shadow-sm mt-5">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Campagne Deelname Verdeling</h5>
        </div>
        <div class="card-body">
            <div style="height: 400px;">
                <canvas id="campaignPieChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Lopende Campagnes -->
    <div class="card shadow-sm mt-5">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">Lopende Campagnes</h5>
        </div>
        <div class="card-body">
            <ul>
                <li><strong>Slim Wassen</strong>: Bespaar 10% op warm water. <button class="btn btn-sm btn-primary">Bekijk</button></li>
                <li><strong>LED-Actie</strong>: Ontvang korting op LED-lampen. <button class="btn btn-sm btn-primary">Meedoen</button></li>
                <li><strong>Eco Thermostaat</strong>: Leer slimmer verwarmen. <button class="btn btn-sm btn-primary">Start</button></li>
            </ul>
        </div>
    </div>

    <!-- Kostenbesparing -->
    <div class="card shadow-sm mt-5">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Totale Kostenbesparing</h5>
        </div>
        <div class="card-body">
            <p>Je bespaart momenteel <strong>22%</strong> ten opzichte van je vorige energieverbruik.</p>
            <p>Gemiddelde terugverdientijd voor campagnes: <strong>8 maanden</strong>.</p>
        </div>
    </div>

    <!-- Tevredenheidsfeedback -->
    <div class="card shadow-sm mt-5 mb-5">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Wat vind jij van je energiebesparing?</h5>
        </div>
        <div class="card-body">
            <form>
                <label for="feedback">Jouw mening:</label><br>
                <textarea id="feedback" class="form-control" rows="3" placeholder="Laat hier je feedback achter..."></textarea><br>
                <button class="btn btn-success">Verzenden</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Balkgrafiek - Energieverbruik
        new Chart(document.getElementById('energyChart'), {
            type: 'bar',
            data: {
                labels: ['Januari', 'Februari', 'Maart', 'April'],
                datasets: [{
                    label: 'Verbruik (kWh)',
                    data: [180, 290, 60, 250],
                    backgroundColor: [ 
                        'rgba(54, 162, 235, 0.7)',
                        
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                     
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
                }
            }
        });

        // Cirkelgrafiek - Campagneverdeling
        new Chart(document.getElementById('campaignPieChart'), {
            type: 'doughnut',
            data: {
                labels: ['Slim Wassen', 'LED-Actie', 'Eco Thermostaat'],
                datasets: [{
                    label: 'Deelnameverdeling',
                    data: [40, 35, 25],
                    backgroundColor: [
                        'rgba(75, 192, 75, 0.7)',   // Groen
                        'rgba(255, 205, 86, 0.7)',  // Geel
                        'rgba(255, 99, 132, 0.7)'   // Rood
                    ],
                    borderColor: [
                        'rgba(75, 192, 75, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });
</script>
@endpush
 