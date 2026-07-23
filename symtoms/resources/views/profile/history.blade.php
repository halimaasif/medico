<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medico - Diagnostic History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            /* Nayi theme ke CSS variables */
            --royal-blue: #0f2027;
            --accent-gold: #c5a059;
            --deep-black: #000000;
            --white: #f5f6fa;
            
            /* Structural compatibility variables */
            --glass-border: rgba(197, 160, 89, 0.25);
            --accent-cyan: var(--accent-gold);
        }
        body {
            background-color: var(--royal-blue);
            background-image: 
                radial-gradient(at 5% 15%, rgba(197, 160, 89, 0.12) 0px, transparent 45%),
                radial-gradient(at 95% 85%, rgba(0, 0, 0, 0.6) 0px, transparent 45%);
            color: var(--white);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }
        .profile-menu-item { transition: all 0.2s ease; }
        .profile-menu-item:hover {
            background: rgba(197, 160, 89, 0.08) !important;
            color: var(--accent-gold) !important;
            transform: translateX(4px);
        }
        .navbar-profile-toggle:hover {
            box-shadow: 0 0 15px rgba(197, 160, 89, 0.4);
            transform: scale(1.05);
        }
        
        /* Table overrides to match gold concept */
        .history-table th {
            background: rgba(15, 32, 39, 0.6) !important;
            color: var(--accent-gold) !important;
            border-bottom: 2px solid var(--glass-border);
            font-weight: 600;
        }
        .history-table td {
            background: transparent !important;
            color: var(--white);
            border-bottom: 1px solid rgba(197, 160, 89, 0.15);
            vertical-align: middle;
        }
        .history-row {
            transition: background 0.2s ease;
        }
        .history-row:hover {
            background: rgba(197, 160, 89, 0.05) !important;
        }

        /* Color utilities mapped to gold */
        .text-info {
            color: var(--accent-gold) !important;
        }
        .btn-outline-info {
            color: var(--accent-gold) !important;
            border-color: var(--accent-gold) !important;
        }
        .btn-outline-info:hover {
            background-color: var(--accent-gold) !important;
            color: var(--deep-black) !important;
        }
        .bg-info {
            background-color: var(--accent-gold) !important;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-3" style="background: rgba(0, 0, 0, 0.75); backdrop-filter: blur(15px); border-bottom: 1px solid var(--glass-border);">
        <div class="container">
            <a class="navbar-brand font-weight-bold d-flex align-items-center" href="/symptom-checker" style="font-weight: 700; color: var(--white);">
                <i class="bi bi-heart-pulse-fill text-info me-2"></i> Medico
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link text-white bg-white bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center p-0 navbar-profile-toggle" 
                               href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 42px; height: 42px; border: 1px solid var(--accent-cyan); transition: all 0.3s ease;">
                                <i class="bi bi-person-fill text-info fs-5"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end mt-2 p-3" aria-labelledby="profileDropdown" style="background: rgba(15, 32, 39, 0.96); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); border-radius: 20px; min-width: 260px; box-shadow: 0 15px 35px rgba(0,0,0,0.6);">
                                <div class="text-center py-2 px-1 mb-2 border-bottom border-secondary border-opacity-25">
                                    <div class="bg-info bg-opacity-10 text-info rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 50px; height: 50px; border: 1px dashed var(--accent-cyan);">
                                        <i class="bi bi-person-badge-fill fs-4"></i>
                                    </div>
                                    <h6 class="text-white m-0 font-weight-bold">{{ Auth::user()->name }}</h6>
                                    <span class="text-muted d-block mt-1 text-truncate" style="font-size: 0.78rem;"><i class="bi bi-envelope me-1"></i>{{ Auth::user()->email }}</span>
                                </div>
                                <li class="my-1">
                                    <a class="dropdown-item text-light rounded-3 py-2 small d-flex align-items-center gap-2 profile-menu-item" href="{{ route('profile.settings') }}">
                                        <i class="bi bi-sliders text-info"></i> Profile Settings
                                    </a>
                                </li>
                                <li class="my-1">
                                    <a class="dropdown-item text-light rounded-3 py-2 small d-flex align-items-center gap-2 profile-menu-item" href="{{ route('diagnostic.history') }}">
                                        <i class="bi bi-clock-history text-warning"></i> Diagnostic History
                                    </a>
                                </li>
                                <hr class="border-secondary border-opacity-25 my-2">
                                <li class="mt-1">
                                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm w-100 rounded-pill py-2 d-flex align-items-center justify-content-center gap-2" style="font-weight: 500;">
                                            <i class="bi bi-box-arrow-right"></i> Logout Account
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="card text-white shadow-lg mb-5" style="border-radius: 24px; background: rgba(15, 32, 39, 0.6); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.5) !important;">
            <div class="card-header border-secondary border-opacity-25 py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 text-info d-flex align-items-center gap-2">
                    <i class="bi bi-clock-history text-warning"></i> Clinical Diagnostic History
                </h5>
                <a href="/symptom-checker" class="btn btn-outline-info btn-sm rounded-pill px-3"><i class="bi bi-plus-circle me-1"></i> New Test</a>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table history-table text-white">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Searched Symptoms</th>
                                <th>Expected Condition</th>
                                <th>Severity Level</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($history as $item)
                            <tr class="history-row">
                                <td class="text-white small">{{ $item->created_at->format('M d, Y - h:i A') }}</td>
                                <td><span class="badge bg-white bg-opacity-5 text-info px-3 py-2 rounded-pill border" style="border-color: rgba(197, 160, 89, 0.2) !important;">{{ $item->keywords }}</span></td>
                                <td class="fw-bold text-white">{{ $item->condition_name }}</td>
                                <td>
                                    @if(str_contains(strtolower($item->severity_levels), 'high') || str_contains(strtolower($item->severity_levels), 'critical'))
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20 px-2 py-1 rounded">High Critical</span>
                                    @else
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20 px-2 py-1 rounded">Normal</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-light rounded-circle" title="View Details"><i class="bi bi-eye"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-folder-x fs-1 d-block mb-2 text-secondary"></i>
                                    No diagnostic records found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>