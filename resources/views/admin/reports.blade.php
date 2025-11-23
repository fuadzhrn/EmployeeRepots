<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Laporan - Admin Dashboard</title>
    <style>
        body {
            background: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: 280px;
            background: linear-gradient(135deg, #007E7A 0%, #005f5a 100%);
            color: white;
            padding: 20px 0;
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-header img {
            width: 50px;
            height: auto;
            border-radius: 8px;
        }

        .sidebar-header-text h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .sidebar-header-text p {
            margin: 0;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.7);
        }

        .sidebar-menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s;
            font-size: 14px;
            font-weight: 500;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid white;
            padding-left: 16px;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logout-btn {
            width: 100%;
            padding: 12px;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            font-family: "Montserrat", sans-serif;
            font-size: 13px;
        }

        .logout-btn:hover {
            background: rgba(255, 0, 0, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .admin-content {
            flex: 1;
            margin-left: 280px;
            padding: 30px;
        }

        .admin-header {
            background: white;
            padding: 20px 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            margin-bottom: 30px;
        }

        .admin-header h1 {
            margin: 0;
            font-size: 28px;
            color: #072033;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.3s;
        }

        .stat-card:hover {
            box-shadow: 0 8px 20px rgba(0, 126, 122, 0.1);
            transform: translateY(-4px);
        }

        .stat-label {
            font-size: 13px;
            color: #7a8896;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: #007E7A;
            margin: 0;
        }

        .chart-section {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            margin-bottom: 30px;
        }

        .chart-title {
            font-size: 18px;
            font-weight: 700;
            color: #072033;
            margin: 0 0 24px 0;
            padding-bottom: 16px;
            border-bottom: 2px solid #f0f0f0;
        }

        .chart-container {
            position: relative;
            height: 350px;
            margin-bottom: 20px;
        }

        @media (max-width: 1024px) {
            .admin-sidebar {
                width: 240px;
            }

            .admin-content {
                margin-left: 240px;
            }
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
                width: 240px;
                z-index: 1100;
            }

            .admin-content {
                margin-left: 0;
                padding: 20px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('asset/logo_putihvale.png') }}" alt="Logo">
                <div class="sidebar-header-text">
                    <h3>Admin</h3>
                    <p>Dashboard</p>
                </div>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <span>📊</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.requests') }}">
                        <span>📋</span>
                        <span>Kelola Request</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}">
                        <span>👥</span>
                        <span>Kelola User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reports') }}" class="active">
                        <span>📈</span>
                        <span>Laporan</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-content">
            <div class="admin-header">
                <h1>Laporan</h1>
            </div>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Request</div>
                    <p class="stat-value">{{ $totalRequests }}</p>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Selesai</div>
                    <p class="stat-value">{{ $completedRequests }}</p>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Persentase Selesai</div>
                    <p class="stat-value">{{ $totalRequests > 0 ? round(($completedRequests / $totalRequests) * 100, 2) : 0 }}%</p>
                </div>
            </div>

            <!-- Chart untuk Kategori -->
            <div class="chart-section">
                <h2 class="chart-title">Request Berdasarkan Kategori</h2>
                <div class="chart-container">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>

            <!-- Chart untuk Bulan -->
            <div class="chart-section">
                <h2 class="chart-title">Request Berdasarkan Bulan</h2>
                <div class="chart-container">
                    <canvas id="monthChart"></canvas>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Chart kategori
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryLabels = @json($requestsByCategory->pluck('category'));
        const categoryCounts = @json($requestsByCategory->pluck('count'));

        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: categoryLabels,
                datasets: [{
                    data: categoryCounts,
                    backgroundColor: [
                        'rgba(0, 126, 122, 0.7)',
                        'rgba(33, 150, 243, 0.7)',
                        'rgba(255, 193, 7, 0.7)',
                        'rgba(76, 175, 80, 0.7)',
                        'rgba(244, 67, 54, 0.7)',
                    ],
                    borderColor: [
                        'rgba(0, 126, 122, 1)',
                        'rgba(33, 150, 243, 1)',
                        'rgba(255, 193, 7, 1)',
                        'rgba(76, 175, 80, 1)',
                        'rgba(244, 67, 54, 1)',
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                family: '"Montserrat", sans-serif',
                                size: 13,
                                weight: '600'
                            },
                            padding: 16
                        }
                    }
                }
            }
        });

        // Chart bulan
        const monthCtx = document.getElementById('monthChart').getContext('2d');
        const monthLabels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const monthCounts = @json($requestsByMonth->pluck('count'));

        new Chart(monthCtx, {
            type: 'line',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Request',
                    data: monthCounts,
                    borderColor: 'rgba(0, 126, 122, 1)',
                    backgroundColor: 'rgba(0, 126, 122, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgba(0, 126, 122, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                family: '"Montserrat", sans-serif',
                                size: 13,
                                weight: '600'
                            },
                            padding: 16
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                family: '"Montserrat", sans-serif',
                                size: 12
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                family: '"Montserrat", sans-serif',
                                size: 12
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
