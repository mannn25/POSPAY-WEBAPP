@extends('layout.template')
@section('title', 'Dashboard')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-black mb-1">Dashboard Overview</h2>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card h-100 p-3">
                <div class="d-flex justify-content-between mb-3">
                    <div class="stat-icon" style="background: rgba(19, 127, 236, 0.1); color: var(--primary-blue);">
                        <span class="material-symbols-outlined">group</span>
                    </div>
                    <span class="trend-up small fw-bold d-flex align-items-center">+5.2% <span
                            class="material-symbols-outlined" style="font-size: 14px">trending_up</span></span>
                </div>
                <p class="text-muted small mb-1">Total Users</p>
                <h3 class="mb-0 fw-bold">{{ $totalUser }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 p-3">
                <div class="d-flex justify-content-between mb-3">
                    <div class="stat-icon" style="background: rgba(11, 218, 91, 0.1); color: #0bda5b;">
                        <span class="material-symbols-outlined">grid_view</span>
                    </div>
                    <span class="text-muted small fw-bold">Stable <span class="material-symbols-outlined"
                            style="font-size: 14px">remove</span></span>
                </div>
                <p class="text-muted small mb-1">Active Services</p>
                <h3 class="mb-0 fw-bold">{{ $totalService }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 p-3">
                <div class="d-flex justify-content-between mb-3">
                    <div class="stat-icon" style="background: rgba(255, 165, 0, 0.1); color: #ffa500;">
                        <span class="material-symbols-outlined">swap_horiz</span>
                    </div>
                    <span class="trend-up small fw-bold d-flex align-items-center">+12.4% <span
                            class="material-symbols-outlined" style="font-size: 14px">trending_up</span></span>
                </div>
                <p class="text-muted small mb-1">Total Transactions</p>
                <h3 class="mb-0 fw-bold">{{ $totalTransaction }}</h3>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100 p-3">
                <div class="d-flex justify-content-between mb-3">
                    <div class="stat-icon" style="background: rgba(0, 255, 255, 0.1); color: #00ffff;">
                        <span class="material-symbols-outlined">payments</span>
                    </div>
                    <span class="trend-up small fw-bold d-flex align-items-center">+8.1% <span
                            class="material-symbols-outlined" style="font-size: 14px">trending_up</span></span>
                </div>
                <p class="text-muted small mb-1">Total Revenue</p>
                <h3 class="mb-0 fw-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold mb-1">Transaction Overview</h5>
                        <p class="text-muted small mb-0">Volume of transactions for the last 7 days</p>
                    </div>
                    <span class="badge rounded-pill" style="background: rgba(11, 218, 91, 0.1); color: #0bda5b;">
                        {{ $totalTransaction > 0 ? 'Active' : '0' }}
                    </span>
                </div>
                <div style="height: 300px; position: relative;">
                    <canvas id="transactionChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card p-4 h-100">
                <h5 class="fw-bold mb-1">Service Distribution</h5>
                <p class="text-muted small mb-4">Market share by service type</p>

                <div class="d-flex flex-column align-items-center justify-content-center position-relative"
                    style="height: 280px;">

                    <canvas id="serviceChart"></canvas>

                    <div class="position-absolute text-center"
                        style="top: 30%; left: 50%; transform: translate(-50%, -50%); pointer-events: none;">
                        <h3 class="mb-0 fw-bold" style="font-size: 24px; line-height: 1;">{{ $totalSuccessTransactions }}
                        </h3>
                        <p class="text-muted small text-uppercase mb-0"
                            style="font-size: 10px; font-weight: bold; opacity: 0.6;">TOTAL</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //service distribution
        document.addEventListener("DOMContentLoaded", function() {
            // ... (Script Transaction Chart Anda tetap ada di sini)
            const canvas = document.getElementById('transactionChart');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');

            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(13, 110, 253, 0.2)');
            gradient.addColorStop(1, 'rgba(13, 110, 253, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Total Transaksi',
                        data: {!! json_encode($chartData) !!},
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: '#0D6EFD',
                        tension: 0.4,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1, // Memaksa angka bulat (1, 2, 3...)
                                precision: 0 // Menghilangkan desimal
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // --- SCRIPT UNTUK SERVICE DISTRIBUTION ---
            const serviceCtx = document.getElementById('serviceChart').getContext('2d');

            new Chart(serviceCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($serviceLabels) !!},
                    datasets: [{
                        data: {!! json_encode($serviceCounts) !!},
                        backgroundColor: ['#0D6EFD', '#0bda5b', '#ffa500', '#00ffff', '#6f42c1'],
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '65%',
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            align: 'start',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                font: {
                                    size: 12
                                },
                                // FUNGSI UNTUK MENAMPILKAN PERSEN
                                generateLabels: (chart) => {
                                    const data = chart.data;
                                    if (data.labels.length && data.datasets.length) {
                                        const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                        return data.labels.map((label, i) => {
                                            const value = data.datasets[0].data[i];
                                            const percentage = total > 0 ? ((value / total) *
                                                100).toFixed(0) : 0;
                                            return {
                                                text: `${label} (${percentage}%)`, // Tampilan: Nama Layanan (42%)
                                                fillStyle: data.datasets[0].backgroundColor[i],
                                                strokeStyle: data.datasets[0].backgroundColor[
                                                    i],
                                                pointStyle: 'circle',
                                                hidden: isNaN(value) || chart.getDatasetMeta(0)
                                                    .data[i].hidden,
                                                index: i
                                            };
                                        });
                                    }
                                    return [];
                                }
                            }
                        }
                    },
                    layout: {
                        padding: {
                            bottom: 10
                        }
                    }
                }
            });
        });
    </script>
@endsection
