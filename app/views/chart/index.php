<div class="container-md mt-4">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Chart Sales
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Chart Info
                </div>
                <div class="card-body">
                    <canvas id="ChartInfo"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart js -->
<script src="<?= BASEULR; ?>/js/chart.js"></script>
<script script>
    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [<?php foreach ($data['label'] as $label) {
                            echo '"' . $label['name'] . '",';
                        } ?>],
            datasets: [{
                label: '# of Votes',
                data: [<?php foreach ($data['data'] as $sold) {
                            echo '"' . $sold['sold'] . '",';
                        } ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const chartInfo = document.getElementById('ChartInfo').getContext('2d');
    const ChartInfo = new Chart(chartInfo, {
        type: 'doughnut',
        data: {
            labels: [<?php foreach ($data['product'] as $label) {
                            echo '"' . $label['name'] . '",';
                        } ?>],
            datasets: [{
                label: '# of Votes',
                data: [<?php foreach ($data['product'] as $product) {
                            echo '"' . $product['quantity'] . '",';
                        } ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>