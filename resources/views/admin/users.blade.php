<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Kelola User - Admin Dashboard</title>
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

        .role-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .role-admin {
            background: #cfe2ff;
            color: #084298;
        }

        .role-user {
            background: #f0f0f0;
            color: #476172;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.2s;
            font-family: "Montserrat", sans-serif;
        }

        .btn-danger {
            background: #ff6b6b;
            color: white;
        }

        .btn-danger:hover {
            background: #ff5252;
            transform: translateY(-1px);
        }

        .btn-danger:disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 8px;
        }

        .pagination a, .pagination span {
            padding: 8px 12px;
            border: 1px solid #e8ecf1;
            border-radius: 6px;
            text-decoration: none;
            color: #007E7A;
            font-size: 13px;
            font-weight: 600;
        }

        .pagination a:hover {
            background: #f0f0f0;
        }

        .pagination .active {
            background: #007E7A;
            color: white;
            border-color: #007E7A;
        }

        .success-message, .error-message {
            border-radius: 6px;
            padding: 12px 14px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .success-message {
            background: #d1e7dd;
            border-left: 4px solid #4ade80;
            color: #0f5132;
        }

        .error-message {
            background: #fee;
            border-left: 4px solid #ff6b6b;
            color: #c41e3a;
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
                    <a href="{{ route('admin.users') }}" class="active">
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
                <h1>Kelola User</h1>
            </div>

            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="error-message">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-section">
                <h2 class="table-title">Daftar User</h2>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Terdaftar</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                <td><strong>{{ $user->username }}</strong></td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="role-badge role-{{ $user->role }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="action-buttons">
                                        @if ($user->id !== auth()->id())
                                            <form action="{{ route('admin.user.delete', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        @else
                                            <button class="btn btn-danger" disabled title="Tidak bisa menghapus akun sendiri">Hapus</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align: center; color: #999;">Tidak ada user</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if ($users->hasPages())
                    <div class="pagination-container">
                        {{ $users->links('vendor.pagination.custom') }}
                    </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>
