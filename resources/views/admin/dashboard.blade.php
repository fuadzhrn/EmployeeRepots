<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    <!-- Google Fonts - Montserrat -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Admin Dashboard - Request Management System</title>
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

        /* Sidebar */
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

        .sidebar-menu li {
            margin: 0;
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

        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.15);
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

        /* Main Content */
        .admin-content {
            flex: 1;
            margin-left: 280px;
            padding: 30px;
        }

        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .admin-header h1 {
            margin: 0;
            font-size: 28px;
            color: #072033;
        }

        .admin-user-info {
            text-align: right;
        }

        .admin-user-info p {
            margin: 0;
            font-size: 14px;
            color: #476172;
        }

        .admin-user-info strong {
            color: #007E7A;
            display: block;
            font-size: 15px;
        }

        /* Stats Cards */
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

        /* Chart Section */
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

        .table-section {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .table-title {
            font-size: 18px;
            font-weight: 700;
            color: #072033;
            margin: 0 0 20px 0;
            padding-bottom: 16px;
            border-bottom: 2px solid #f0f0f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table thead {
            background: #f8f9fa;
        }

        table th {
            padding: 14px;
            text-align: left;
            font-weight: 700;
            color: #072033;
            border-bottom: 2px solid #e8ecf1;
        }

        table td {
            padding: 14px;
            border-bottom: 1px solid #e8ecf1;
            color: #476172;
        }

        table tbody tr:hover {
            background: #f8f9fa;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-proses {
            background: #cfe2ff;
            color: #084298;
        }

        .status-selesai {
            background: #d1e7dd;
            color: #0f5132;
        }

        .status-select {
            padding: 6px 10px;
            border: 1px solid #e8ecf1;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            font-family: "Montserrat", sans-serif;
            background: white;
            color: #072033;
            cursor: pointer;
            transition: all 0.2s ease;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 8px center;
            background-size: 16px;
            padding-right: 32px;
        }

        .status-select:hover {
            border-color: #007E7A;
            box-shadow: 0 0 0 2px rgba(0, 126, 122, 0.1);
        }

        .status-select:focus {
            outline: none;
            border-color: #007E7A;
            box-shadow: 0 0 0 3px rgba(0, 126, 122, 0.15);
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

            .admin-sidebar.active {
                transform: translateX(0);
            }

            .admin-content {
                margin-left: 0;
                padding: 20px;
            }

            .admin-header {
                flex-direction: column;
                gap: 16px;
                align-items: flex-start;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .table-section {
                overflow-x: auto;
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
                    <a href="{{ route('admin.dashboard') }}" class="active">
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
                    <a href="{{ route('admin.reports') }}">
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
                <div>
                    <h1>Dashboard</h1>
                </div>
                <div class="admin-user-info">
                    <p>Selamat datang,</p>
                    <strong>{{ auth()->user()->username ?? 'Admin' }}</strong>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-label">Total Request</div>
                    <p class="stat-value">{{ $stats['total'] ?? 0 }}</p>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Pending</div>
                    <p class="stat-value">{{ $stats['pending'] ?? 0 }}</p>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Sedang Proses</div>
                    <p class="stat-value">{{ $stats['proses'] ?? 0 }}</p>
                </div>
                <div class="stat-card">
                    <div class="stat-label">Selesai</div>
                    <p class="stat-value">{{ $stats['selesai'] ?? 0 }}</p>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="chart-section">
                <h2 class="chart-title">Statistik Request per Bulan</h2>
                <div class="chart-container">
                    <canvas id="requestChart"></canvas>
                </div>
            </div>

            <!-- Recent Requests Table -->
            <div class="table-section">
                <h2 class="table-title">Request Terbaru</h2>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Request Name</th>
                            <th>Badge No</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentRequests ?? [] as $request)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $request->nama ?? '-' }}</td>
                                <td>{{ $request->nomor ?? '-' }}</td>
                                <td>{{ $request->category ?? '-' }}</td>
                                <td>
                                    <form action="{{ route('admin.request.status', $request->id) }}" method="POST" style="margin: 0; display: inline;">
                                        @csrf
                                        <select name="status" class="status-select" onchange="this.form.submit()">
                                            <option value="pending" {{ ($request->status ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="proses" {{ ($request->status ?? 'pending') === 'proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="selesai" {{ ($request->status ?? 'pending') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </form>
                                </td>
                                <td>{{ $request->created_at ? $request->created_at->format('d M Y') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: #999;">Tidak ada request</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        // Chart.js Configuration
        const ctx = document.getElementById('requestChart').getContext('2d');
        
        // Data dari Laravel
        const chartData = {
            labels: @json($chartLabels ?? []),
            datasets: [
                {
                    label: 'Pending',
                    data: @json($chartPending ?? []),
                    backgroundColor: 'rgba(255, 193, 7, 0.6)',
                    borderColor: 'rgba(255, 193, 7, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                },
                {
                    label: 'Sedang Proses',
                    data: @json($chartProses ?? []),
                    backgroundColor: 'rgba(33, 150, 243, 0.6)',
                    borderColor: 'rgba(33, 150, 243, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                },
                {
                    label: 'Selesai',
                    data: @json($chartSelesai ?? []),
                    backgroundColor: 'rgba(76, 175, 80, 0.6)',
                    borderColor: 'rgba(76, 175, 80, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                }
            ]
        };

        new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                family: '"Montserrat", sans-serif',
                                size: 13,
                                weight: '600'
                            },
                            padding: 16,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 20,
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
