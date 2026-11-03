<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Blood Donation System')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: #0f172a;
            color: #f8fafc;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background: #111827;
            border-right: 1px solid #1f2937;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #9ca3af;
            border-radius: 10px;
            transition: 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            background: #7f1d1d;
            color: white;
        }

        .dashboard-card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 16px;
            padding: 24px;
        }

        .table-container {
            background: #1e293b;
            border-radius: 16px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #111827;
            color: #9ca3af;
            text-align: left;
            padding: 16px;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #334155;
        }

        tr:hover {
            background: #273449;
        }

        .btn-primary {
            background: #dc2626;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #b91c1c;
        }

        input, select {
            background: #0f172a;
            color: white;
            border: 1px solid #334155;
            padding: 10px;
            border-radius: 8px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="sidebar w-64 p-5 flex flex-col">

        <div class="flex items-center gap-3 mb-10">
            <div class="bg-red-600 rounded-xl p-3 text-xl">🩸</div>

            <div>
                <h1 class="font-bold text-lg">BloodCare</h1>
                <p class="text-xs text-gray-400">Donation System</p>
            </div>
        </div>

        <p class="text-xs uppercase text-gray-500 mb-3">Main Menu</p>

        <nav class="space-y-2">

            <a href="{{ route('donors.index') }}"
               class="nav-link {{ request()->routeIs('donors.*') ? 'active' : '' }}">
                <span>👥</span> Donor Management
            </a>

            <a href="{{ route('donation-logs.index') }}"
               class="nav-link {{ request()->routeIs('donation-logs.*') ? 'active' : '' }}">
                <span>🩸</span> Donation Logs
            </a>

            <a href="#" class="nav-link">
                <span>📍</span> Campaigns
            </a>

            <a href="#" class="nav-link">
                <span>🧑‍⚕️</span> Phlebotomists
            </a>

        </nav>

        <div class="mt-auto pt-8">
            <div class="bg-gray-800 p-4 rounded-xl">
                <p class="text-sm font-semibold">Blood Donation</p>
                <p class="text-xs text-gray-400 mt-1">
                    Every drop saves a life.
                </p>
            </div>
        </div>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content flex-1 p-6 md:p-10">

        <header class="flex justify-between items-center mb-8">

            <div>
                <p class="text-sm text-gray-400">Blood Donation System</p>
                <h2 class="text-2xl font-bold">@yield('page-title')</h2>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-right">
                    <p class="text-sm font-semibold">Administrator</p>
                    <p class="text-xs text-gray-400">System Admin</p>
                </div>

                <div class="bg-red-600 rounded-full w-10 h-10 flex items-center justify-center">
                    A
                </div>
            </div>

        </header>

        @if(session('success'))
            <div class="bg-green-900 text-green-300 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')

    </main>

</div>

</body>
</html>
