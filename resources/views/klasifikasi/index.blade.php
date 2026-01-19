<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klasifikasi Beasiswa - Naive Bayes</title>

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
            max-width: 800px;
            margin: 0 auto;
        }

        /* Header Styles */
        .page-header {
            background: white;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--card-shadow);
            border-left: 4px solid var(--primary-color);
        }

        .header-title {
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header-subtitle {
            color: var(--secondary-color);
            font-size: 0.95rem;
        }

        /* Algorithm Info */
        .algorithm-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            color: var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #bfdbfe;
            font-weight: 500;
            margin-left: 1rem;
        }

        /* Form Card */
        .form-card {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            box-shadow: var(--card-shadow);
            background: white;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .form-card-header {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem;
            font-weight: 600;
            color: #1e293b;
        }

        .form-card-body {
            padding: 1.5rem;
        }

        /* Input Section */
        .input-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            background: white;
            transition: all 0.2s ease;
        }

        .input-section:hover {
            border-color: var(--primary-color);
            box-shadow: var(--card-shadow-hover);
        }

        .input-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .input-icon {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .input-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.25rem;
            font-size: 1.1rem;
        }

        .input-description {
            color: var(--secondary-color);
            font-size: 0.875rem;
        }

        /* IPK Colors */
        .input-ipk .input-icon {
            background-color: #dbeafe;
            color: #1e40af;
        }

        /* Penghasilan Colors */
        .input-penghasilan .input-icon {
            background-color: #dcfce7;
            color: #166534;
        }

        /* Tanggungan Colors */
        .input-tanggungan .input-icon {
            background-color: #fef3c7;
            color: #92400e;
        }

        /* Select Styles */
        .form-select-custom {
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.875rem 1rem;
            font-size: 1rem;
            transition: all 0.2s ease;
            background: white;
            width: 100%;
        }

        .form-select-custom:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            outline: none;
        }

        .form-select-custom.valid {
            border-color: var(--success-color);
            background-color: #f0fdf4;
        }

        /* Option Styles */
        .option-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 0;
        }

        .option-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .option-ipk-rendah .option-badge {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .option-ipk-sedang .option-badge {
            background-color: #fef3c7;
            color: #92400e;
        }
        .option-ipk-tinggi .option-badge {
            background-color: #d1fae5;
            color: #065f46;
        }

        .option-penghasilan-rendah .option-badge {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .option-penghasilan-sedang .option-badge {
            background-color: #e0e7ff;
            color: #3730a3;
        }
        .option-penghasilan-tinggi .option-badge {
            background-color: #f3e8ff;
            color: #5b21b6;
        }

        .option-tanggungan-sedikit .option-badge {
            background-color: #f0f9ff;
            color: #0369a1;
        }
        .option-tanggungan-banyak .option-badge {
            background-color: #fff1f2;
            color: #9f1239;
        }

        /* Tips Box */
        .tips-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            padding: 1rem;
            margin-top: 1rem;
            font-size: 0.875rem;
        }

        .tips-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Button Styles */
        .btn-primary-custom {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.875rem 2rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1.05rem;
        }

        .btn-primary-custom:hover {
            background-color: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .btn-outline-custom {
            background-color: transparent;
            border: 1px solid #cbd5e1;
            color: #64748b;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-outline-custom:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            background-color: #f0f9ff;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 1.25rem;
            text-align: center;
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
        }

        .stat-icon {
            font-size: 1.75rem;
            margin-bottom: 0.75rem;
            display: block;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #64748b;
        }

        /* Alert Styles */
        .alert-custom {
            border: 1px solid;
            border-radius: 0.375rem;
            padding: 1rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .alert-danger {
            background-color: #fef2f2;
            border-color: #fecaca;
            color: #991b1b;
        }

        .alert-info {
            background-color: #f0f9ff;
            border-color: #bfdbfe;
            color: #1e40af;
        }

        /* Footer */
        .page-footer {
            border-top: 1px solid #e2e8f0;
            padding: 1.5rem 0;
            color: #64748b;
            font-size: 0.875rem;
            text-align: center;
            margin-top: 2rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .input-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="container container-main py-4">
        <!-- Header -->
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h1 class="header-title">
                        <i class="bi bi-calculator"></i>
                        Klasifikasi Beasiswa
                    </h1>
                    <p class="header-subtitle">
                        Analisis kelayakan menggunakan algoritma Naive Bayes
                    </p>
                </div>
                <span class="algorithm-badge">
                    <i class="bi bi-cpu"></i>
                    Naive Bayes
                </span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ url('/training') }}" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left"></i> Kembali ke Data Training
            </a>
            <div class="text-end">
                <small class="text-muted">
                    <i class="bi bi-info-circle"></i>
                    Lengkapi semua data untuk analisis
                </small>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="stats-grid">
            <div class="stat-card">
                <i class="bi bi-database stat-icon text-primary"></i>
                <div class="stat-value">{{ $totalData ?? 0 }}</div>
                <div class="stat-label">Data Training</div>
            </div>
            <div class="stat-card">
                <i class="bi bi-check-circle stat-icon text-success"></i>
                <div class="stat-value">{{ $layakCount ?? 0 }}</div>
                <div class="stat-label">Layak Diterima</div>
            </div>
            <div class="stat-card">
                <i class="bi bi-x-circle stat-icon text-danger"></i>
                <div class="stat-value">{{ $tidakLayakCount ?? 0 }}</div>
                <div class="stat-label">Tidak Layak</div>
            </div>
            <div class="stat-card">
                <i class="bi bi-clock stat-icon text-warning"></i>
                <div class="stat-value">{{ $accuracy ?? '0' }}%</div>
                <div class="stat-label">Akurasi Model</div>
            </div>
        </div>

        <!-- Info Alert -->
        <div class="alert alert-info alert-custom">
            <i class="bi bi-info-circle"></i>
            <div>
                <strong>Panduan:</strong> Masukkan data calon penerima beasiswa untuk dianalisis menggunakan model Naive Bayes yang telah dilatih.
            </div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
        <div class="alert alert-danger alert-custom">
            <i class="bi bi-exclamation-triangle"></i>
            <div>
                <strong>Kesalahan Validasi:</strong> Silakan periksa kembali data yang diinput.
                <ul class="mb-0 mt-1 small">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <!-- Form Card -->
        <div class="form-card">
            <div class="form-card-header">
                Form Data Calon Penerima
            </div>
            
            <div class="form-card-body">
                <form action="{{ route('klasifikasi.process') }}" method="POST" id="klasifikasiForm">
                    @csrf

                    <!-- IPK Input -->
                    <div class="input-section input-ipk">
                        <div class="input-header">
                            <div class="input-icon">
                                <i class="bi bi-mortarboard"></i>
                            </div>
                            <div>
                                <div class="input-title">Indeks Prestasi Kumulatif (IPK)</div>
                                <div class="input-description">Pilih kategori IPK berdasarkan nilai akhir</div>
                            </div>
                        </div>
                        
                        <select name="ipk" class="form-select-custom" id="ipkSelect" required>
                            <option value="">-- Pilih Kategori IPK --</option>
                            <option value="Rendah" {{ old('ipk') == 'Rendah' ? 'selected' : '' }}>
                                Rendah
                            </option>
                            <option value="Sedang" {{ old('ipk') == 'Sedang' ? 'selected' : '' }}>
                                Sedang
                            </option>
                            <option value="Tinggi" {{ old('ipk') == 'Tinggi' ? 'selected' : '' }}>
                                Tinggi
                            </option>
                        </select>
                        
                        <div class="tips-box">
                            <div class="tips-title">
                                <i class="bi bi-lightbulb"></i>
                                Informasi Kategori
                            </div>
                            <ul class="mb-0 small">
                                <li><strong>Rendah:</strong> IPK di bawah 2.75</li>
                                <li><strong>Sedang:</strong> IPK antara 2.75 - 3.50</li>
                                <li><strong>Tinggi:</strong> IPK di atas 3.50</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Penghasilan Input -->
                    <div class="input-section input-penghasilan">
                        <div class="input-header">
                            <div class="input-icon">
                                <i class="bi bi-cash-coin"></i>
                            </div>
                            <div>
                                <div class="input-title">Penghasilan Orang Tua</div>
                                <div class="input-description">Pilih kategori penghasilan orang tua per bulan</div>
                            </div>
                        </div>
                        
                        <select name="penghasilan" class="form-select-custom" id="penghasilanSelect" required>
                            <option value="">-- Pilih Kategori Penghasilan --</option>
                            <option value="Rendah" {{ old('penghasilan') == 'Rendah' ? 'selected' : '' }}>
                                Rendah
                            </option>
                            <option value="Sedang" {{ old('penghasilan') == 'Sedang' ? 'selected' : '' }}>
                                Sedang
                            </option>
                            <option value="Tinggi" {{ old('penghasilan') == 'Tinggi' ? 'selected' : '' }}>
                                Tinggi
                            </option>
                        </select>
                        
                        <div class="tips-box">
                            <div class="tips-title">
                                <i class="bi bi-lightbulb"></i>
                                Informasi Kategori
                            </div>
                            <ul class="mb-0 small">
                                <li><strong>Rendah:</strong> Di bawah Rp 3.000.000/bulan</li>
                                <li><strong>Sedang:</strong> Rp 3-6 juta/bulan</li>
                                <li><strong>Tinggi:</strong> Di atas Rp 6.000.000/bulan</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Tanggungan Input -->
                    <div class="input-section input-tanggungan">
                        <div class="input-header">
                            <div class="input-icon">
                                <i class="bi bi-people"></i>
                            </div>
                            <div>
                                <div class="input-title">Jumlah Tanggungan</div>
                                <div class="input-description">Pilih kategori jumlah anggota keluarga yang ditanggung</div>
                            </div>
                        </div>
                        
                        <select name="tanggungan" class="form-select-custom" id="tanggunganSelect" required>
                            <option value="">-- Pilih Kategori Tanggungan --</option>
                            <option value="Sedikit" {{ old('tanggungan') == 'Sedikit' ? 'selected' : '' }}>
                                Sedikit
                            </option>
                            <option value="Banyak" {{ old('tanggungan') == 'Banyak' ? 'selected' : '' }}>
                                Banyak
                            </option>
                        </select>
                        
                        <div class="tips-box">
                            <div class="tips-title">
                                <i class="bi bi-lightbulb"></i>
                                Informasi Kategori
                            </div>
                            <ul class="mb-0 small">
                                <li><strong>Sedikit:</strong> 1-3 orang</li>
                                <li><strong>Banyak:</strong> Lebih dari 3 orang</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn-primary-custom" id="submitBtn">
                            <i class="bi bi-calculator"></i>
                            Proses Klasifikasi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Section -->
        <div class="row mt-4">
            <div class="col-md-6 mb-3">
                <div class="input-section">
                    <h6 class="mb-3"><i class="bi bi-info-circle me-2"></i>Tentang Algoritma</h6>
                    <p class="small text-muted mb-0">
                        Naive Bayes adalah algoritma klasifikasi probabilistik yang efektif untuk analisis data kategorikal. 
                        Algoritma ini menghitung probabilitas setiap kelas berdasarkan data training yang tersedia.
                    </p>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="input-section">
                    <h6 class="mb-3"><i class="bi bi-clock me-2"></i>Proses Klasifikasi</h6>
                    <ul class="small text-muted mb-0">
                        <li>Hitung prior probability dari data training</li>
                        <li>Hitung likelihood setiap atribut</li>
                        <li>Hitung posterior probability</li>
                        <li>Prediksi kelas dengan probabilitas tertinggi</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="page-footer">
            <div class="row align-items-center">
                <div class="col-md-6 text-md-start mb-2 mb-md-0">
                    <small>
                        <i class="bi bi-calendar me-1"></i>
                        {{ now()->format('d M Y H:i') }}
                    </small>
                </div>
                <div class="col-md-6 text-md-end">
                    <small>
                        <i class="bi bi-shield-check me-1"></i>
                        Sistem Klasifikasi Beasiswa &copy; {{ date('Y') }}
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form elements
            const form = document.getElementById('klasifikasiForm');
            const submitBtn = document.getElementById('submitBtn');
            const selectElements = {
                ipk: document.getElementById('ipkSelect'),
                penghasilan: document.getElementById('penghasilanSelect'),
                tanggungan: document.getElementById('tanggunganSelect')
            };
            
            // Update select styles on change
            Object.keys(selectElements).forEach(field => {
                const select = selectElements[field];
                if (select) {
                    // Set initial state
                    if (select.value) {
                        select.classList.add('valid');
                    }
                    
                    // Update on change
                    select.addEventListener('change', function() {
                        if (this.value) {
                            this.classList.add('valid');
                        } else {
                            this.classList.remove('valid');
                        }
                        validateForm();
                    });
                }
            });
            
            // Form validation
            function validateForm() {
                const allFilled = Object.values(selectElements).every(select => select.value);
                submitBtn.disabled = !allFilled;
                
                if (!allFilled) {
                    submitBtn.innerHTML = '<i class="bi bi-exclamation-circle"></i> Lengkapi Semua Data';
                    submitBtn.classList.remove('btn-primary-custom');
                    submitBtn.classList.add('btn-secondary');
                } else {
                    submitBtn.innerHTML = '<i class="bi bi-calculator"></i> Proses Klasifikasi';
                    submitBtn.classList.remove('btn-secondary');
                    submitBtn.classList.add('btn-primary-custom');
                }
            }
            
            // Form submission with SweetAlert
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Check if all fields are filled
                const allFilled = Object.values(selectElements).every(select => select.value);
                
                if (!allFilled) {
                    Swal.fire({
                        title: 'Data Belum Lengkap',
                        html: `
                            <div class="text-start">
                                <p>Silakan lengkapi semua data berikut:</p>
                                <ul class="small">
                                    ${!selectElements.ipk.value ? '<li>Indeks Prestasi Kumulatif (IPK)</li>' : ''}
                                    ${!selectElements.penghasilan.value ? '<li>Penghasilan Orang Tua</li>' : ''}
                                    ${!selectElements.tanggungan.value ? '<li>Jumlah Tanggungan</li>' : ''}
                                </ul>
                            </div>
                        `,
                        icon: 'warning',
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#64748b'
                    });
                    return;
                }
                
                // Show confirmation
                Swal.fire({
                    title: 'Konfirmasi Klasifikasi',
                    html: `
                        <div class="text-start">
                            <p>Data yang akan diproses:</p>
                            <div class="bg-light p-3 rounded mb-3">
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <div class="text-muted small">IPK</div>
                                        <div class="fw-medium">${selectElements.ipk.value}</div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="text-muted small">Penghasilan</div>
                                        <div class="fw-medium">${selectElements.penghasilan.value}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-muted small">Tanggungan</div>
                                        <div class="fw-medium">${selectElements.tanggungan.value}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-info small mb-0">
                                <i class="bi bi-info-circle"></i>
                                Klasifikasi akan menggunakan algoritma Naive Bayes.
                            </div>
                        </div>
                    `,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Proses Klasifikasi',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#2563eb',
                    cancelButtonColor: '#64748b'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state
                        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Memproses...';
                        submitBtn.disabled = true;
                        
                        // Show processing modal
                        Swal.fire({
                            title: 'Memproses Klasifikasi',
                            html: `
                                <div class="text-center">
                                    <div class="spinner-border text-primary mb-3" style="width: 3rem; height: 3rem;" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mb-1">Menganalisis data menggunakan Naive Bayes...</p>
                                    <small class="text-muted d-block">
                                        <i class="bi bi-cpu"></i>
                                        Menghitung probabilitas dan prediksi
                                    </small>
                                </div>
                            `,
                            showConfirmButton: false,
                            allowOutsideClick: false
                        });
                        
                        // Submit the form
                        setTimeout(() => {
                            form.submit();
                        }, 1500);
                    }
                });
            });
            
            // Demo data feature (Ctrl + D)
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey && e.key === 'd') {
                    e.preventDefault();
                    
                    selectElements.ipk.value = 'Tinggi';
                    selectElements.penghasilan.value = 'Rendah';
                    selectElements.tanggungan.value = 'Banyak';
                    
                    // Trigger change events
                    Object.values(selectElements).forEach(select => {
                        select.dispatchEvent(new Event('change'));
                        select.classList.add('valid');
                    });
                    
                    Swal.fire({
                        title: 'Data Demo Dimasukkan',
                        text: 'Data contoh telah diisi. Klik "Proses Klasifikasi" untuk melanjutkan.',
                        icon: 'success',
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#10b981'
                    });
                }
            });
            
            // Initialize form validation
            validateForm();
            
            // Show success message if redirected with success
            @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#10b981'
            });
            @endif
        });
    </script>
</body>
</html>