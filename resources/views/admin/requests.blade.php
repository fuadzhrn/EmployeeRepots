<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Kelola Request - Admin Dashboard</title>
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

        .table-section {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        }

        .table-title {
            font-size: 16px;
            font-weight: 700;
            color: #072033;
            margin: 0 0 16px 0;
            padding-bottom: 16px;
            border-bottom: 2px solid #f0f0f0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        table thead {
            background: #f8f9fa;
        }

        table th {
            padding: 12px;
            text-align: left;
            font-weight: 700;
            color: #072033;
            border-bottom: 2px solid #e8ecf1;
            font-size: 12px;
        }

        table td {
            padding: 12px;
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

        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .btn {
            padding: 6px 10px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 11px;
            font-weight: 600;
            transition: all 0.2s;
            font-family: "Montserrat", sans-serif;
            white-space: nowrap;
        }

        .btn-primary {
            background: #007E7A;
            color: white;
        }

        .btn-primary:hover {
            background: #005f5a;
            transform: translateY(-1px);
        }

        .btn-success {
            background: #4ade80;
            color: #0f5132;
        }

        .btn-success:hover {
            background: #22c55e;
        }

        .btn-warning {
            background: #fbbf24;
            color: #78350f;
        }

        .btn-warning:hover {
            background: #f59e0b;
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

        .file-actions {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-file {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 4px;
            border: 1px solid #e8ecf1;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-view {
            background: #e0f2fe;
            border-color: #0284c7;
        }

        .btn-view:hover {
            background: #0284c7;
            color: white;
        }

        .btn-download {
            background: #dcfce7;
            border-color: #16a34a;
        }

        .btn-download:hover {
            background: #16a34a;
            color: white;
        }

        .pagination {
            margin-top: 24px;
            display: flex;
            justify-content: center;
            gap: 4px;
            align-items: center;
            flex-wrap: wrap;
        }

        .pagination-container {
            margin-top: 24px;
        }

        .pagination a, .pagination span {
            padding: 6px 10px;
            border: 1px solid #e8ecf1;
            border-radius: 4px;
            text-decoration: none;
            color: #007E7A;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s;
            min-width: auto;
        }

        .pagination a:hover {
            background: #f0f0f0;
            border-color: #007E7A;
        }

        .pagination .active {
            background: #007E7A;
            color: white;
            border-color: #007E7A;
        }

        .pagination span.disabled {
            color: #ccc;
            cursor: not-allowed;
        }

        .success-message {
            background: #d1e7dd;
            border-left: 4px solid #4ade80;
            padding: 12px 14px;
            border-radius: 6px;
            color: #0f5132;
            font-size: 13px;
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

            .table-section {
                overflow-x: auto;
            }

            .action-buttons {
                flex-direction: column;
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
                    <a href="{{ route('admin.requests') }}" class="active">
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
                <h1>Kelola Request</h1>
            </div>

            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-section">
                <h2 class="table-title">Daftar Request</h2>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Request Name</th>
                            <th>Badge No</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>File</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                            <tr>
                                <td>{{ ($requests->currentPage() - 1) * $requests->perPage() + $loop->iteration }}</td>
                                <td>{{ $request->nama }}</td>
                                <td>{{ $request->nomor }}</td>
                                <td>{{ ucfirst($request->category) }}</td>
                                <td>
                                    <form action="{{ route('admin.request.status', $request->id) }}" method="POST" style="margin: 0; display: inline;">
                                        @csrf
                                        <select name="status" class="status-select" onchange="this.form.submit()">
                                            <option value="pending" {{ $request->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="proses" {{ $request->status === 'proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="selesai" {{ $request->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    @if($request->document)
                                        <div class="file-actions">
                                            <a href="{{ route('request.view', $request->id) }}" class="btn-file btn-view" target="_blank" title="View">👁️</a>
                                            <a href="{{ route('request.download', $request->id) }}" class="btn-file btn-download" title="Download">⬇️</a>
                                        </div>
                                    @else
                                        <span style="color: #999;">No file</span>
                                    @endif
                                </td>
                                <td>{{ $request->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; color: #999;">Tidak ada request</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($requests->hasPages())
                    <div class="pagination-container">
                        {{ $requests->links('vendor.pagination.custom') }}
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>
