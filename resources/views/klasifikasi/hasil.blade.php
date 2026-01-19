<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Klasifikasi - Sistem Beasiswa</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/NaiveBayes1.png') }}">
    
    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- Custom Styles (Konsisten dengan halaman lain) -->
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
            max-width: 1000px;
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

        /* Algorithm Badge */
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
        }

        /* Result Card */
        .result-card {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 1.5rem;
            background: white;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
        }

        .result-header {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            border-radius: 0.5rem 0.5rem 0 0 !important;
        }

        /* Prediction Badge */
        .prediction-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .prediction-layak {
            background-color: #d1fae5;
            color: #065f46;
            border: 2px solid #a7f3d0;
        }

        .prediction-tidak-layak {
            background-color: #fee2e2;
            color: #991b1b;
            border: 2px solid #fecaca;
        }

        /* Input Data Badges */
        .input-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        /* IPK Colors */
        .badge-ipk-rendah { 
            background-color: #fee2e2; 
            color: #991b1b; 
        }
        .badge-ipk-sedang { 
            background-color: #fef3c7; 
            color: #92400e; 
        }
        .badge-ipk-tinggi { 
            background-color: #d1fae5; 
            color: #065f46; 
        }

        /* Penghasilan Colors */
        .badge-penghasilan-rendah { 
            background-color: #dbeafe; 
            color: #1e40af; 
        }
        .badge-penghasilan-sedang { 
            background-color: #e0e7ff; 
            color: #3730a3; 
        }
        .badge-penghasilan-tinggi { 
            background-color: #f3e8ff; 
            color: #5b21b6; 
        }

        /* Tanggungan Colors */
        .badge-tanggungan-sedikit { 
            background-color: #f0f9ff; 
            color: #0369a1; 
        }
        .badge-tanggungan-banyak { 
            background-color: #fff1f2; 
            color: #9f1239; 
        }

        /* Probability Section */
        .probability-section {
            margin-bottom: 2rem;
        }

        .probability-header {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Probability Cards */
        .probability-card {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 1.5rem;
            background: white;
            transition: all 0.2s ease;
            height: 100%;
        }

        .probability-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow-hover);
        }

        .probability-card-layak {
            border-left: 4px solid var(--success-color);
        }

        .probability-card-tidak-layak {
            border-left: 4px solid var(--danger-color);
        }

        .probability-value {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .probability-label {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 1rem;
        }

        /* Probability Bar */
        .probability-bar {
            height: 20px;
            background-color: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            margin: 1rem 0;
            position: relative;
        }

        .probability-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 1.5s ease-in-out;
        }

        .fill-layak {
            background: linear-gradient(90deg, #10b981, #34d399);
        }

        .fill-tidak-layak {
            background: linear-gradient(90deg, #ef4444, #f87171);
        }

        .probability-percentage {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        /* Chart Container */
        .chart-container {
            height: 300px;
            margin: 2rem 0;
            padding: 1rem;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
        }

        /* Decision Card */
        .decision-card {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 1.5rem;
            background: white;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--warning-color);
        }

        .decision-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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
            margin-bottom: 1rem;
        }

        .alert-success {
            background-color: #f0fdf4;
            border-color: #bbf7d0;
            color: #166534;
        }

        .alert-warning {
            background-color: #fffbeb;
            border-color: #fde68a;
            color: #92400e;
        }

        .alert-info {
            background-color: #f0f9ff;
            border-color: #bfdbfe;
            color: #1e40af;
        }

        /* Button Styles (Konsisten) */
        .btn-primary-custom {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
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
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
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
            }
            
            .action-buttons .btn {
                width: 100%;
                justify-content: center;
            }
            
            .probability-value {
                font-size: 2rem;
            }
            
            .chart-container {
                height: 250px;
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
                        <i class="bi bi-graph-up"></i>
                        Hasil Klasifikasi Beasiswa
                    </h1>
                    <p class="header-subtitle">
                        Analisis menggunakan algoritma Naive Bayes
                    </p>
                </div>
                <span class="algorithm-badge">
                    <i class="bi bi-cpu"></i>
                    Naive Bayes Algorithm
                </span>
            </div>
        </div>

        <!-- Input Data -->
        <div class="result-card">
            <div class="result-header">
                Data Input
            </div>
            <div class="p-4">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="mb-2">
                            <small class="text-muted d-block">IPK</small>
                            <span class="input-badge badge-ipk-{{ strtolower($ipk) }}">
                                {{ $ipk }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="mb-2">
                            <small class="text-muted d-block">Penghasilan</small>
                            <span class="input-badge badge-penghasilan-{{ strtolower($penghasilan) }}">
                                {{ $penghasilan }}
                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="mb-2">
                            <small class="text-muted d-block">Tanggungan</small>
                            <span class="input-badge badge-tanggungan-{{ strtolower($tanggungan) }}">
                                {{ $tanggungan }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Probability Results -->
        <div class="probability-section">
            <h5 class="probability-header">
                <i class="bi bi-percent"></i>
                Hasil Probabilitas
            </h5>
            
            <div class="row">
                <!-- Layak Probability -->
                <div class="col-md-6 mb-4">
                    <div class="probability-card probability-card-layak">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h6 class="fw-bold mb-1">Layak Diterima</h6>
                                <small class="text-muted">Probabilitas kelayakan</small>
                            </div>
                            <div class="bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">
                                <i class="bi bi-check-circle"></i>
                            </div>
                        </div>
                        
                        <div class="probability-value text-success">
                            {{ number_format($hasilLayak * 100, 2) }}%
                        </div>
                        
                        <div class="probability-label">
                            Nilai: {{ number_format($hasilLayak, 4) }}
                        </div>
                        
                        <div class="probability-bar">
                            <div class="probability-fill fill-layak" 
                                 style="width: {{ $hasilLayak * 100 }}%">
                                <span class="probability-percentage">{{ number_format($hasilLayak * 100, 1) }}%</span>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Peluang untuk diterima beasiswa
                            </small>
                        </div>
                    </div>
                </div>
                
                <!-- Tidak Layak Probability -->
                <div class="col-md-6 mb-4">
                    <div class="probability-card probability-card-tidak-layak">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h6 class="fw-bold mb-1">Tidak Layak</h6>
                                <small class="text-muted">Probabilitas ketidaklayakan</small>
                            </div>
                            <div class="bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-1">
                                <i class="bi bi-x-circle"></i>
                            </div>
                        </div>
                        
                        <div class="probability-value text-danger">
                            {{ number_format($hasilTidak * 100, 2) }}%
                        </div>
                        
                        <div class="probability-label">
                            Nilai: {{ number_format($hasilTidak, 4) }}
                        </div>
                        
                        <div class="probability-bar">
                            <div class="probability-fill fill-tidak-layak" 
                                 style="width: {{ $hasilTidak * 100 }}%">
                                <span class="probability-percentage">{{ number_format($hasilTidak * 100, 1) }}%</span>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Peluang untuk tidak diterima
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Prediction Result -->
        <div class="decision-card">
            <h5 class="decision-title">
                <i class="bi bi-clipboard-check"></i>
                Keputusan Klasifikasi
            </h5>
            
            <div class="row align-items-center">
                <div class="col-md-8">
                    <p class="mb-0">
                        Berdasarkan analisis Naive Bayes dengan data training yang tersedia, 
                        calon penerima beasiswa diprediksi:
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="prediction-badge prediction-{{ strtolower($keputusan) }}">
                        <i class="bi {{ $keputusan == 'Layak' ? 'bi-check-circle' : 'bi-x-circle' }}"></i>
                        {{ $keputusan }}
                    </div>
                    <div class="mt-2">
                        <small class="text-muted">
                            Keyakinan: <strong>{{ number_format(max($hasilLayak, $hasilTidak) * 100, 2) }}%</strong>
                        </small>
                    </div>
                </div>
            </div>
            
            <!-- Result Message -->
            @if($keputusan == 'Layak')
            <div class="alert alert-success alert-custom mt-3">
                <i class="bi bi-check-circle-fill"></i>
                <div>
                    <strong>Rekomendasi:</strong> Calon penerima beasiswa dinyatakan <strong>LAYAK</strong>. 
                    Probabilitas kelayakan lebih tinggi dari ketidaklayakan.
                </div>
            </div>
            @else
            <div class="alert alert-warning alert-custom mt-3">
                <i class="bi bi-exclamation-triangle"></i>
                <div>
                    <strong>Rekomendasi:</strong> Calon penerima beasiswa dinyatakan <strong>TIDAK LAYAK</strong>. 
                    Probabilitas ketidaklayakan lebih tinggi dari kelayakan.
                </div>
            </div>
            @endif
            
            <!-- Statistics -->
            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="text-muted small">Total Data Training</div>
                        <div class="fw-bold">{{ $totalData ?? 30 }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="text-muted small">Selisih Probabilitas</div>
                        <div class="fw-bold">{{ number_format(abs($hasilLayak - $hasilTidak) * 100, 2) }}%</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <div class="text-muted small">Dominan</div>
                        <div class="fw-bold {{ $hasilLayak > $hasilTidak ? 'text-success' : 'text-danger' }}">
                            {{ $hasilLayak > $hasilTidak ? 'Layak' : 'Tidak Layak' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Visualization -->
        <div class="chart-container">
            <canvas id="probabilityChart"></canvas>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <a href="{{ url('/training') }}" class="btn btn-outline-custom">
                <i class="bi bi-arrow-left"></i> Data Training
            </a>
            <div class="text-center">
                <small class="text-muted d-block">
                    <i class="bi bi-calendar me-1"></i>
                    {{ now()->format('d M Y H:i') }}
                </small>
            </div>
            <a href="{{ url('/klasifikasi') }}" class="btn btn-primary-custom">
                <i class="bi bi-arrow-repeat"></i> Klasifikasi Baru
            </a>
        </div>

        <!-- Footer -->
        <div class="page-footer">
            <div class="row align-items-center">
                <div class="col-md-6 text-md-start mb-2 mb-md-0">
                    <small>
                        <i class="bi bi-shield-check me-1"></i>
                        Sistem Klasifikasi Beasiswa &copy; {{ date('Y') }}
                    </small>
                </div>
                <div class="col-md-6 text-md-end">
                    <small>
                        <i class="bi bi-cpu me-1"></i>
                        Algoritma: Naive Bayes • Data: {{ $totalData ?? 30 }} records
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate probability bars
            const bars = document.querySelectorAll('.probability-fill');
            bars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });

            // Create chart
            const ctx = document.getElementById('probabilityChart').getContext('2d');
            const probabilityChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Layak', 'Tidak Layak'],
                    datasets: [{
                        data: [
                            {{ $hasilLayak * 100 }},
                            {{ $hasilTidak * 100 }}
                        ],
                        backgroundColor: [
                            'rgba(16, 185, 129, 0.8)',
                            'rgba(239, 68, 68, 0.8)'
                        ],
                        borderColor: [
                            'rgba(16, 185, 129, 1)',
                            'rgba(239, 68, 68, 1)'
                        ],
                        borderWidth: 2,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: {
                                    size: 14,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.parsed.toFixed(2)}%`;
                                }
                            }
                        }
                    },
                    cutout: '60%',
                    animation: {
                        animateScale: true,
                        animateRotate: true,
                        duration: 1500
                    }
                }
            });

            // Show success message if "Layak"
            @if($keputusan == 'Layak')
            setTimeout(() => {
                Swal.fire({
                    title: '🎉 LAYAK DITERIMA!',
                    text: 'Calon penerima beasiswa dinyatakan layak berdasarkan analisis Naive Bayes.',
                    icon: 'success',
                    confirmButtonText: 'Mengerti',
                    confirmButtonColor: '#10b981',
                    timer: 4000,
                    timerProgressBar: true
                });
            }, 1000);
            @endif

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    window.location.href = "{{ url('/klasifikasi') }}";
                }
                if (e.ctrlKey && e.key === 'p') {
                    e.preventDefault();
                    window.print();
                }
            });
        });
    </script>
</body>
</html>