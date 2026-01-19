<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Training - Sistem Klasifikasi Beasiswa</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/NaiveBayes1.png') }}">
    
    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #64748b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
            --light-bg: #f8fafc;
            --card-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            --card-shadow-hover: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            color: #334155;
        }

        .container-main {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Navigation Styles */
        .main-nav {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 2rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .nav-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 1.25rem;
        }

        .nav-brand:hover {
            color: #1d4ed8;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            gap: 0.5rem;
        }

        .nav-item {
            position: relative;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            color: #64748b;
            text-decoration: none;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .nav-link:hover {
            background-color: #f1f5f9;
            color: #334155;
        }

        .nav-link.active {
            background-color: #eff6ff;
            color: var(--primary-color);
            border-color: #bfdbfe;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -1rem;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 4px;
            background-color: var(--primary-color);
            border-radius: 50%;
        }

        /* Page Header */
        .page-header {
            background: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--card-shadow);
        }

        .header-title {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
        }

        .header-subtitle {
            color: var(--secondary-color);
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        /* Card Styles */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            box-shadow: var(--card-shadow);
            transition: box-shadow 0.2s ease;
            background: white;
            margin-bottom: 1.5rem;
        }

        .card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .card-header {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.25rem;
            font-weight: 600;
            color: #1e293b;
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }

        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .data-table thead th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            padding: 0.875rem 1rem;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .data-table tbody td {
            padding: 1rem;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
        }

        .data-table tbody tr {
            transition: background-color 0.15s ease;
        }

        .data-table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Badge Styles - Custom Colors for Each Value */
        .value-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 500;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        /* IPK Colors */
        .ipk-rendah { 
            background-color: #fee2e2; 
            color: #991b1b; 
            border-color: #fecaca;
        }
        .ipk-sedang { 
            background-color: #fef3c7; 
            color: #92400e; 
            border-color: #fde68a;
        }
        .ipk-tinggi { 
            background-color: #d1fae5; 
            color: #065f46; 
            border-color: #a7f3d0;
        }

        /* Penghasilan Colors */
        .penghasilan-rendah { 
            background-color: #dbeafe; 
            color: #1e40af; 
            border-color: #bfdbfe;
        }
        .penghasilan-sedang { 
            background-color: #e0e7ff; 
            color: #3730a3; 
            border-color: #c7d2fe;
        }
        .penghasilan-tinggi { 
            background-color: #f3e8ff; 
            color: #5b21b6; 
            border-color: #e9d5ff;
        }

        /* Tanggungan Colors */
        .tanggungan-sedikit { 
            background-color: #f0f9ff; 
            color: #0369a1; 
            border-color: #e0f2fe;
        }
        .tanggungan-banyak { 
            background-color: #fff1f2; 
            color: #9f1239; 
            border-color: #ffe4e6;
        }

        /* Status Colors */
        .status-badge {
            padding: 0.375rem 0.875rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        .status-layak {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }

        .status-tidak-layak {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* Button Styles */
        .btn-primary-custom {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem 1.25rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary-custom:hover {
            background-color: #1d4ed8;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .btn-outline-custom {
            background-color: transparent;
            border: 1px solid #cbd5e1;
            color: #64748b;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        .btn-outline-custom:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            background-color: #f0f9ff;
        }

        .btn-danger-custom {
            background-color: transparent;
            border: 1px solid #fecaca;
            color: var(--danger-color);
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
        }

        .btn-danger-custom:hover {
            background-color: #fee2e2;
            border-color: var(--danger-color);
        }

        /* Stat Cards */
        .stat-card {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 1.25rem;
            background: white;
            transition: transform 0.2s ease;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
        }

        /* Alert Styles */
        .alert-custom {
            border: 1px solid;
            border-radius: 0.375rem;
            padding: 0.875rem 1rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }

        .alert-info {
            background-color: #f0f9ff;
            border-color: #bfdbfe;
            color: #1e40af;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        /* Empty State */
        .empty-state {
            padding: 3rem 1rem;
            text-align: center;
            color: #64748b;
        }

        .empty-state-icon {
            font-size: 3rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }

        /* Footer */
        .page-footer {
            border-top: 1px solid #e2e8f0;
            padding: 1rem 0;
            color: #64748b;
            font-size: 0.875rem;
            text-align: center;
            background: white;
            border-radius: 0 0 0.5rem 0.5rem;
        }

        /* Page Indicator */
        .page-indicator {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            background-color: #f1f5f9;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            color: #64748b;
            margin-right: 1rem;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .nav-menu {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .data-table {
                font-size: 0.875rem;
            }
            
            .stat-card {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="main-nav">
        <div class="container container-main">
            <div class="nav-container">
                <a href="{{ url('/') }}" class="nav-brand">
                    <i class="bi bi-award-fill"></i>
                    <span>Sistem Beasiswa NB</span>
                </a>
                
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ url('/training') }}" class="nav-link {{ request()->is('training*') ? 'active' : '' }}">
                            <i class="bi bi-database"></i> Data Training
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/klasifikasi') }}" class="nav-link {{ request()->is('klasifikasi*') ? 'active' : '' }}">
                            <i class="bi bi-calculator"></i> Klasifikasi
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container container-main">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="d-flex align-items-center mb-2">
                        <span class="page-indicator">
                            <i class="bi bi-database me-1"></i>Training Data
                        </span>
                        <h1 class="header-title mb-0">Data Training Beasiswa</h1>
                    </div>
                    <p class="header-subtitle">
                        Dataset untuk algoritma Naive Bayes • Total <strong>{{ count($data) }}</strong> data training
                    </p>
                </div>
                <div>
                    <a href="{{ url('/training/create') }}" class="btn btn-primary-custom">
                        <i class="bi bi-plus-lg"></i>Tambah Data
                    </a>
                </div>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="alert alert-success alert-custom">
            <i class="bi bi-check-circle-fill"></i>
            <div>
                {{ session('success') }}
                <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        <div class="alert alert-info alert-custom">
            <i class="bi bi-info-circle"></i>
            <div>
                <strong>Panduan Warna:</strong> 
                <span class="badge ipk-rendah ms-2 me-1">IPK Rendah</span>
                <span class="badge ipk-sedang me-1">IPK Sedang</span>
                <span class="badge ipk-tinggi me-2">IPK Tinggi</span>
                
                <span class="badge penghasilan-rendah me-1">Penghasilan Rendah</span>
                <span class="badge penghasilan-sedang me-1">Penghasilan Sedang</span>
                <span class="badge penghasilan-tinggi me-2">Penghasilan Tinggi</span>
                
                <span class="badge tanggungan-sedikit me-1">Tanggungan Sedikit</span>
                <span class="badge tanggungan-banyak">Tanggungan Banyak</span>
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Daftar Data Training</span>
                <span class="text-muted" style="font-size: 0.875rem;">
                    <i class="bi bi-clock me-1"></i>{{ now()->format('d/m/Y H:i') }}
                </span>
            </div>
            
            <div class="card-body p-0">
                @if(count($data) > 0)
                <div class="table-responsive">
                    <table class="table data-table mb-0">
                        <thead>
                            <tr>
                                <th width="60">#</th>
                                <th>IPK</th>
                                <th>Penghasilan Orang Tua</th>
                                <th>Jumlah Tanggungan</th>
                                <th>Status Kelayakan</th>
                                <th width="160" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $row)
                            @php
                                // Determine badge classes based on values
                                $ipkClass = 'ipk-' . strtolower($row->ipk);
                                $penghasilanClass = 'penghasilan-' . strtolower($row->penghasilan);
                                $tanggunganClass = 'tanggungan-' . strtolower($row->tanggungan);
                                $statusClass = $row->status == 'Layak' ? 'status-layak' : 'status-tidak-layak';
                                $statusIcon = $row->status == 'Layak' ? 'bi-check-circle' : 'bi-x-circle';
                            @endphp
                            <tr>
                                <td class="text-muted fw-medium">{{ $index + 1 }}</td>
                                
                                <td>
                                    <span class="value-badge {{ $ipkClass }}">
                                        <i class="bi bi-mortarboard me-1"></i>{{ $row->ipk }}
                                    </span>
                                </td>
                                
                                <td>
                                    <span class="value-badge {{ $penghasilanClass }}">
                                        <i class="bi bi-cash-coin me-1"></i>{{ $row->penghasilan }}
                                    </span>
                                </td>
                                
                                <td>
                                    <span class="value-badge {{ $tanggunganClass }}">
                                        <i class="bi bi-people me-1"></i>{{ $row->tanggungan }}
                                    </span>
                                </td>
                                
                                <td>
                                    <span class="status-badge {{ $statusClass }}">
                                        <i class="bi {{ $statusIcon }}"></i>{{ $row->status }}
                                    </span>
                                </td>
                                
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ url('/training/' . $row->id . '/edit') }}" 
                                           class="btn btn-outline-custom btn-sm"
                                           title="Edit Data">
                                            <i class="bi bi-pencil-square"></i>
                                            <span class="d-none d-md-inline">Edit</span>
                                        </a>
                                        
                                        <button type="button" 
                                                class="btn btn-danger-custom btn-sm delete-btn"
                                                data-id="{{ $row->id }}"
                                                data-ipk="{{ $row->ipk }}"
                                                data-penghasilan="{{ $row->penghasilan }}"
                                                data-tanggungan="{{ $row->tanggungan }}"
                                                data-status="{{ $row->status }}"
                                                title="Hapus Data">
                                            <i class="bi bi-trash"></i>
                                            <span class="d-none d-md-inline">Hapus</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-database-x"></i>
                    </div>
                    <h4 class="mb-2">Belum Ada Data Training</h4>
                    <p class="mb-3">Mulai dengan menambahkan data training untuk sistem klasifikasi.</p>
                    <a href="{{ url('/training/create') }}" class="btn btn-primary-custom">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Data Pertama
                    </a>
                </div>
                @endif
            </div>
            
            <!-- Footer with Navigation -->
            <div class="page-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <small>
                        <i class="bi bi-shield-check me-1"></i>
                        Sistem Klasifikasi Beasiswa &copy; {{ date('Y') }}
                    </small>
                    
                    <!-- Page Navigation -->
                    <div class="d-flex gap-2">
                        <a href="{{ url('/login') }}" class="btn btn-outline-custom btn-sm">
                            <i class="bi bi-arrow-left"></i> Logout
                        </a>
                        <a href="{{ url('/klasifikasi') }}" class="btn btn-primary-custom btn-sm">
                            Klasifikasi Baru <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Section -->
        @if(count($data) > 0)
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-value text-success">
                        {{ $data->where('status', 'Layak')->count() }}
                    </div>
                    <div class="stat-label">Layak Diterima</div>
                    <div class="mt-2">
                        <small class="text-muted">
                            {{ number_format(($data->where('status', 'Layak')->count() / count($data)) * 100, 1) }}% dari total
                        </small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-value text-danger">
                        {{ $data->where('status', 'Tidak Layak')->count() }}
                    </div>
                    <div class="stat-label">Tidak Layak</div>
                    <div class="mt-2">
                        <small class="text-muted">
                            {{ number_format(($data->where('status', 'Tidak Layak')->count() / count($data)) * 100, 1) }}% dari total
                        </small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-value" style="color: #065f46;">
                        {{ $data->where('ipk', 'Tinggi')->count() }}
                    </div>
                    <div class="stat-label">IPK Tinggi</div>
                    <div class="mt-2">
                        <small class="text-muted">
                            Kriteria utama kelayakan
                        </small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="stat-card">
                    <div class="stat-value" style="color: #1e40af;">
                        {{ $data->where('penghasilan', 'Rendah')->count() }}
                    </div>
                    <div class="stat-label">Penghasilan Rendah</div>
                    <div class="mt-2">
                        <small class="text-muted">
                            Pertimbangan sosial ekonomi
                        </small>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Additional Stats -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">Distribusi IPK</div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between">
                                <span class="badge ipk-rendah">Rendah</span>
                                <span class="fw-medium">{{ $data->where('ipk', 'Rendah')->count() }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="badge ipk-sedang">Sedang</span>
                                <span class="fw-medium">{{ $data->where('ipk', 'Sedang')->count() }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="badge ipk-tinggi">Tinggi</span>
                                <span class="fw-medium">{{ $data->where('ipk', 'Tinggi')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">Distribusi Penghasilan</div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between">
                                <span class="badge penghasilan-rendah">Rendah</span>
                                <span class="fw-medium">{{ $data->where('penghasilan', 'Rendah')->count() }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="badge penghasilan-sedang">Sedang</span>
                                <span class="fw-medium">{{ $data->where('penghasilan', 'Sedang')->count() }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="badge penghasilan-tinggi">Tinggi</span>
                                <span class="fw-medium">{{ $data->where('penghasilan', 'Tinggi')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-header">Distribusi Tanggungan</div>
                    <div class="card-body">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between">
                                <span class="badge tanggungan-sedikit">Sedikit</span>
                                <span class="fw-medium">{{ $data->where('tanggungan', 'Sedikit')->count() }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="badge tanggungan-banyak">Banyak</span>
                                <span class="fw-medium">{{ $data->where('tanggungan', 'Banyak')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-dismiss alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });

            // Delete Confirmation
            const deleteButtons = document.querySelectorAll('.delete-btn');
            
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const ipk = this.getAttribute('data-ipk');
                    const penghasilan = this.getAttribute('data-penghasilan');
                    const tanggungan = this.getAttribute('data-tanggungan');
                    const status = this.getAttribute('data-status');
                    
                    // Determine badge classes
                    const ipkClass = `ipk-${ipk.toLowerCase()}`;
                    const penghasilanClass = `penghasilan-${penghasilan.toLowerCase()}`;
                    const tanggunganClass = `tanggungan-${tanggungan.toLowerCase()}`;
                    const statusClass = status === 'Layak' ? 'status-layak' : 'status-tidak-layak';
                    
                    Swal.fire({
                        title: 'Konfirmasi Hapus Data',
                        html: `
                            <div class="text-start">
                                <p>Apakah Anda yakin ingin menghapus data training berikut?</p>
                                <div class="bg-light p-3 rounded mb-3">
                                    <div class="row">
                                        <div class="col-6 mb-2">
                                            <div class="text-muted small">IPK</div>
                                            <span class="badge ${ipkClass}">${ipk}</span>
                                        </div>
                                        <div class="col-6 mb-2">
                                            <div class="text-muted small">Penghasilan</div>
                                            <span class="badge ${penghasilanClass}">${penghasilan}</span>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-muted small">Tanggungan</div>
                                            <span class="badge ${tanggunganClass}">${tanggungan}</span>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-muted small">Status</div>
                                            <span class="badge ${statusClass}">${status}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-warning small mb-0">
                                    <i class="bi bi-exclamation-triangle me-1"></i>
                                    Data yang dihapus akan mempengaruhi akurasi model klasifikasi.
                                </div>
                            </div>
                        `,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#64748b',
                        reverseButtons: true,
                        customClass: {
                            confirmButton: 'btn btn-danger-custom',
                            cancelButton: 'btn btn-outline-custom'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Create and submit delete form
                            const form = document.createElement('form');
                            form.method = 'POST';
                            form.action = `/training/${id}`;
                            
                            const csrfToken = document.createElement('input');
                            csrfToken.type = 'hidden';
                            csrfToken.name = '_token';
                            csrfToken.value = '{{ csrf_token() }}';
                            
                            const methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';
                            
                            form.appendChild(csrfToken);
                            form.appendChild(methodField);
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });

            // Show success message with SweetAlert
            @if(session('success'))
            Swal.fire({
                title: 'Berhasil',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#2563eb',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
            @endif

            // Show error messages
            @if($errors->any())
            Swal.fire({
                title: 'Validasi Error',
                html: `
                    <div class="text-start">
                        <p class="mb-2">Terdapat kesalahan dalam input data:</p>
                        <ul class="small">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                `,
                icon: 'error',
                confirmButtonText: 'Mengerti',
                confirmButtonColor: '#64748b'
            });
            @endif
        });

        // Simple search functionality
        function setupSearch() {
            const searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.className = 'form-control form-control-sm search-input';
            searchInput.placeholder = 'Cari data...';
            
            const searchContainer = document.querySelector('.card-header');
            if (searchContainer) {
                searchContainer.appendChild(searchInput);
                
                searchInput.addEventListener('input', function(e) {
                    const term = e.target.value.toLowerCase();
                    const rows = document.querySelectorAll('tbody tr');
                    
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(term) ? '' : 'none';
                    });
                });
            }
        }

        // Initialize search
        setupSearch();
    </script>
</body>
</html>