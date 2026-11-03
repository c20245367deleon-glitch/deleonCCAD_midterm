<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Blood Donation System')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #0a0a0a;
            color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background: #111111;
            border-right: 1px solid #262626;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 8px;
            color: #a3a3a3;
            transition: 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #292929;
            color: white;
        }

        .dashboard-card {
            background: #171717;
            border: 1px solid #333333;
            border-radius: 14px;
            padding: 24px;
        }

        .table-container {
            background: #171717;
            border: 1px solid #333333;
            border-radius: 14px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #202020;
            color: #a3a3a3;
            text-align: left;
            padding: 16px;
            font-size: 13px;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #303030;
        }

        tr:hover {
            background: #222222;
        }

        .btn-primary {
            display: inline-block;
            background: #dc2626;
            color: white;
            padding: 11px 18px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #b91c1c;
        }

        .pagination {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border-radius: 6px;
            background: #262626;
            color: #d4d4d4;
        }

        .pagination .active span {
            background: #dc2626;
            color: white;
        }

        @media (max-width: 768px) {
            .app-layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
            }

            .main-content {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<div class="app-layout flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="sidebar w-64 p-5 flex flex-col shrink-0">

        <div class="flex items-center gap-3 mb-10">
            <div class="bg-red-600 rounded-xl p-3 text-xl">
                🩸
            </div>

            <div>
                <h1 class="font-bold text-lg">BloodCare</h1>
                <p class="text-xs text-gray-500">Donation System</p>
            </div>
        </div>

        <p class="text-xs uppercase text-gray-500 mb-3">
            Main Menu
        </p>

        <nav class="space-y-2">

            <a href="{{ route('donors.index') }}"
               class="nav-link {{ request()->routeIs('donors.*') ? 'active' : '' }}">
                <span>👥</span>
                Donor Management
            </a>

            <a href="{{ route('donation-logs.index') }}"
               class="nav-link {{ request()->routeIs('donation-logs.*') ? 'active' : '' }}">
                <span>🩸</span>
                Donation Logs
            </a>

            <a href="#" class="nav-link">
                <span>📍</span>
                Campaigns
            </a>

            <a href="#" class="nav-link">
                <span>🧑‍⚕️</span>
                Phlebotomists
            </a>

        </nav>

        <div class="mt-auto pt-10">
            <div class="bg-neutral-800 p-4 rounded-xl">
                <p class="font-semibold text-sm">BloodCare System</p>

                <p class="text-xs text-gray-400 mt-2">
                    Every drop saves a life.
                </p>
            </div>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content flex-1 min-w-0 p-6 md:p-10">

        <header class="flex justify-between items-center mb-8">

            <div>
                <p class="text-sm text-gray-500">
                    Blood Donation System
                </p>

                <h2 class="text-2xl font-bold mt-1">
                    @yield('page-title')
                </h2>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-sm font-semibold">Administrator</p>
                    <p class="text-xs text-gray-500">System Admin</p>
                </div>

                <div class="bg-red-600 rounded-full w-10 h-10 flex items-center justify-center">
                    A
                </div>
            </div>

        </header>

        @if(session('success'))
            <div class="bg-green-900 text-green-200 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-900 text-red-200 p-4 rounded-lg mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')

    </main>

</div>

</body>
</html>