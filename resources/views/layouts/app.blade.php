<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Destinify')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            width: 240px;
            background-color: #212529;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 1rem;
            transition: 0.3s;
        }

        .sidebar h4 {
            text-align: center;
            color: #ffc107;
            margin-bottom: 1.5rem;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-radius: 8px;
            margin: 4px 10px;
            transition: 0.3s;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #ffc107;
            color: #212529;
        }

        /* Content Area */
        .content {
            margin-left: 250px;
            padding: 30px;
            transition: 0.3s;
        }

        .topbar {
            background-color: white;
            border-bottom: 1px solid #dee2e6;
            padding: 15px 25px;
            margin-bottom: 25px;
            border-radius: 8px;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar h4 {
                margin-bottom: 10px;
            }

            .sidebar a {
                display: inline-block;
                padding: 8px 12px;
                margin: 4px;
            }

            .content {
                margin-left: 0;
                padding: 15px;
            }

            .topbar {
                margin-top: 10px;
                text-align: center;
            }

            table {
                font-size: 0.9rem;
            }

            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar d-lg-block d-none">
        <h4>Destinify</h4>

        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        <a href="{{ route('alternatif.index') }}" class="{{ request()->is('alternatif*') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i> Alternatif
        </a>

        <a href="{{ route('kriteria.index') }}" class="{{ request()->is('kriteria*') ? 'active' : '' }}">
            <i class="bi bi-list-check me-2"></i> Kriteria
        </a>

        <a href="{{ url('pembobotan') }}" class="{{ request()->is('pembobotan*') ? 'active' : '' }}">
            <i class="bi bi-calculator me-2"></i> Pembobotan
        </a>

        <a href="{{ route('penilaian.index') }}" class="{{ request()->is('penilaian*') ? 'active' : '' }}">
            <i class="bi bi-pencil-square me-2"></i> Penilaian Alternatif
        </a>

        <a href="{{ url('perhitungan') }}" class="{{ request()->is('perhitungan*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line me-2"></i> Perhitungan
        </a>
    </div>

    <!-- Navbar (untuk HP) -->
    <nav class="navbar navbar-dark bg-dark d-lg-none">
        <div class="container-fluid">
            <a class="navbar-brand text-warning fw-bold" href="#">Destinify</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="mobileMenu">
            <div class="bg-dark p-2">
                <a href="{{ url('/') }}"
                    class="d-block text-white py-1 {{ request()->is('/') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('alternatif.index') }}"
                    class="d-block text-white py-1 {{ request()->is('alternatif*') ? 'active' : '' }}">Alternatif</a>
                <a href="{{ route('kriteria.index') }}"
                    class="d-block text-white py-1 {{ request()->is('kriteria*') ? 'active' : '' }}">Kriteria</a>
                <a href="{{ url('pembobotan') }}"
                    class="d-block text-white py-1 {{ request()->is('pembobotan*') ? 'active' : '' }}">Pembobotan</a>
                <a href="{{ route('penilaian.index') }}"
                    class="d-block text-white py-1 {{ request()->is('penilaian*') ? 'active' : '' }}">Penilaian</a>
                <a href="{{ url('perhitungan') }}"
                    class="d-block text-white py-1 {{ request()->is('perhitungan*') ? 'active' : '' }}">Perhitungan</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="content">
        <div class="topbar">
            <h5 class="m-0">@yield('page-title')</h5>
        </div>

        <div class="table-responsive">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
