<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Training - Sistem Beasiswa</title>

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

        /* Card Styles */
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

        /* Form Styles */
        .form-label {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-hint {
            color: #64748b;
            font-size: 0.875rem;
            margin-bottom: 1rem;
            display: block;
        }

        /* Option Card Styles */
        .option-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .option-card {
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            background: white;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .option-card:hover {
            border-color: var(--primary-color);
            background-color: #f0f9ff;
            transform: translateY(-2px);
        }

        .option-card.active {
            border-color: var(--primary-color);
            background-color: #eff6ff;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .option-icon {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
            font-size: 1.25rem;
        }

        .option-label {
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.25rem;
        }

        .option-description {
            font-size: 0.75rem;
            color: #64748b;
        }

        /* IPK Colors */
        .option-ipk-rendah .option-icon {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .option-ipk-sedang .option-icon {
            background-color: #fef3c7;
            color: #92400e;
        }
        .option-ipk-tinggi .option-icon {
            background-color: #d1fae5;
            color: #065f46;
        }

        /* Penghasilan Colors */
        .option-penghasilan-rendah .option-icon {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .option-penghasilan-sedang .option-icon {
            background-color: #e0e7ff;
            color: #3730a3;
        }
        .option-penghasilan-tinggi .option-icon {
            background-color: #f3e8ff;
            color: #5b21b6;
        }

        /* Tanggungan Colors */
        .option-tanggungan-sedikit .option-icon {
            background-color: #f0f9ff;
            color: #0369a1;
        }
        .option-tanggungan-banyak .option-icon {
            background-color: #fff1f2;
            color: #9f1239;
        }

        /* Status Colors */
        .option-status-layak .option-icon {
            background-color: #d1fae5;
            color: #065f46;
        }
        .option-status-tidak-layak .option-icon {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Button Styles */
        .btn-primary-custom {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.625rem 1.5rem;
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
            padding: 0.625rem 1.5rem;
            border-radius: 0.375rem;
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

        /* Form Actions */
        .form-actions {
            display: flex;
            justify-content: space-between;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
            margin-top: 1.5rem;
        }

        /* Preview Styles */
        .preview-card {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 1.5rem;
            background: white;
            box-shadow: var(--card-shadow);
        }

        .preview-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .preview-item {
            text-align: center;
            padding: 1rem;
            border-radius: 0.375rem;
            background-color: #f8fafc;
        }

        .preview-label {
            font-size: 0.75rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .preview-value {
            font-weight: 600;
            font-size: 1rem;
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

        /* Responsive */
        @media (max-width: 768px) {
            .option-grid {
                grid-template-columns: 1fr;
            }
            
            .preview-grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .form-actions {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .form-actions .btn {
                width: 100%;
                justify-content: center;
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
                        <i class="bi bi-plus-circle"></i>
                        Tambah Data Training
                    </h1>
                    <p class="header-subtitle">
                        Tambahkan data baru untuk training model Naive Bayes
                    </p>
                </div>
                <a href="{{ url('/training') }}" class="btn btn-outline-custom">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Info Alert -->
        <div class="alert alert-info alert-custom">
            <i class="bi bi-info-circle"></i>
            <div>
                Data training ini akan digunakan untuk melatih model klasifikasi Naive Bayes dalam menentukan kelayakan penerima beasiswa.
            </div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
        <div class="alert alert-danger alert-custom">
            <i class="bi bi-exclamation-triangle"></i>
            <div>
                <strong>Perhatian:</strong> Terdapat kesalahan dalam pengisian form. Silakan periksa kembali.
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
                Form Data Training
            </div>
            
            <div class="form-card-body">
                <form action="{{ url('/training') }}" method="POST" id="trainingForm">
                    @csrf

                    <!-- IPK Field -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-mortarboard"></i>
                            Indeks Prestasi Kumulatif (IPK)
                        </label>
                        <span class="form-hint">Pilih kategori IPK berdasarkan nilai akhir</span>
                        
                        <div class="option-grid">
                            <div class="option-card option-ipk-rendah" data-value="Rendah" data-field="ipk">
                                <div class="option-icon">
                                    <i class="bi bi-emoji-frown"></i>
                                </div>
                                <div class="option-label">Rendah</div>
                                <div class="option-description">&lt; 2.75</div>
                            </div>
                            
                            <div class="option-card option-ipk-sedang" data-value="Sedang" data-field="ipk">
                                <div class="option-icon">
                                    <i class="bi bi-emoji-neutral"></i>
                                </div>
                                <div class="option-label">Sedang</div>
                                <div class="option-description">2.75 - 3.50</div>
                            </div>
                            
                            <div class="option-card option-ipk-tinggi" data-value="Tinggi" data-field="ipk">
                                <div class="option-icon">
                                    <i class="bi bi-emoji-smile"></i>
                                </div>
                                <div class="option-label">Tinggi</div>
                                <div class="option-description">&gt; 3.50</div>
                            </div>
                        </div>
                        <input type="hidden" name="ipk" id="ipk" value="{{ old('ipk') }}" required>
                        @error('ipk')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Penghasilan Field -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-cash-coin"></i>
                            Penghasilan Orang Tua
                        </label>
                        <span class="form-hint">Pilih kategori penghasilan orang tua per bulan</span>
                        
                        <div class="option-grid">
                            <div class="option-card option-penghasilan-rendah" data-value="Rendah" data-field="penghasilan">
                                <div class="option-icon">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="option-label">Rendah</div>
                                <div class="option-description">&lt; Rp 3 juta</div>
                            </div>
                            
                            <div class="option-card option-penghasilan-sedang" data-value="Sedang" data-field="penghasilan">
                                <div class="option-icon">
                                    <i class="bi bi-cash-stack"></i>
                                </div>
                                <div class="option-label">Sedang</div>
                                <div class="option-description">Rp 3-6 juta</div>
                            </div>
                            
                            <div class="option-card option-penghasilan-tinggi" data-value="Tinggi" data-field="penghasilan">
                                <div class="option-icon">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <div class="option-label">Tinggi</div>
                                <div class="option-description">&gt; Rp 6 juta</div>
                            </div>
                        </div>
                        <input type="hidden" name="penghasilan" id="penghasilan" value="{{ old('penghasilan') }}" required>
                        @error('penghasilan')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggungan Field -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-people"></i>
                            Jumlah Tanggungan
                        </label>
                        <span class="form-hint">Pilih kategori jumlah anggota keluarga yang ditanggung</span>
                        
                        <div class="option-grid">
                            <div class="option-card option-tanggungan-sedikit" data-value="Sedikit" data-field="tanggungan">
                                <div class="option-icon">
                                    <i class="bi bi-person-check"></i>
                                </div>
                                <div class="option-label">Sedikit</div>
                                <div class="option-description">1-3 orang</div>
                            </div>
                            
                            <div class="option-card option-tanggungan-banyak" data-value="Banyak" data-field="tanggungan">
                                <div class="option-icon">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="option-label">Banyak</div>
                                <div class="option-description">&gt; 3 orang</div>
                            </div>
                        </div>
                        <input type="hidden" name="tanggungan" id="tanggungan" value="{{ old('tanggungan') }}" required>
                        @error('tanggungan')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status Field -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-clipboard-check"></i>
                            Status Kelayakan
                        </label>
                        <span class="form-hint">Tentukan status kelayakan berdasarkan kondisi di atas</span>
                        
                        <div class="option-grid">
                            <div class="option-card option-status-layak" data-value="Layak" data-field="status">
                                <div class="option-icon">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div class="option-label">Layak</div>
                                <div class="option-description">Diterima beasiswa</div>
                            </div>
                            
                            <div class="option-card option-status-tidak-layak" data-value="Tidak Layak" data-field="status">
                                <div class="option-icon">
                                    <i class="bi bi-x-circle"></i>
                                </div>
                                <div class="option-label">Tidak Layak</div>
                                <div class="option-description">Tidak diterima</div>
                            </div>
                        </div>
                        <input type="hidden" name="status" id="status" value="{{ old('status') }}" required>
                        @error('status')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <a href="{{ url('/training') }}" class="btn btn-outline-custom">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary-custom" id="submitBtn">
                            <i class="bi bi-save"></i> Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Preview Card -->
        <div class="preview-card">
            <h5 class="preview-title">
                <i class="bi bi-eye"></i> Preview Data
            </h5>
            <div class="preview-grid">
                <div class="preview-item" id="preview-ipk-container">
                    <div class="preview-label">IPK</div>
                    <div class="preview-value" id="preview-ipk">-</div>
                </div>
                <div class="preview-item" id="preview-penghasilan-container">
                    <div class="preview-label">Penghasilan</div>
                    <div class="preview-value" id="preview-penghasilan">-</div>
                </div>
                <div class="preview-item" id="preview-tanggungan-container">
                    <div class="preview-label">Tanggungan</div>
                    <div class="preview-value" id="preview-tanggungan">-</div>
                </div>
                <div class="preview-item" id="preview-status-container">
                    <div class="preview-label">Status</div>
                    <div class="preview-value" id="preview-status">-</div>
                </div>
            </div>
        </div>

        <!-- Form Guidelines -->
        <div class="form-card mt-4">
            <div class="form-card-header">
                <i class="bi bi-lightbulb me-2"></i> Panduan Pengisian
            </div>
            <div class="form-card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-2">Kriteria IPK</h6>
                        <ul class="small text-muted mb-3">
                            <li><strong>Rendah:</strong> IPK di bawah 2.75</li>
                            <li><strong>Sedang:</strong> IPK antara 2.75 - 3.50</li>
                            <li><strong>Tinggi:</strong> IPK di atas 3.50</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-2">Kriteria Penghasilan</h6>
                        <ul class="small text-muted mb-0">
                            <li><strong>Rendah:</strong> Di bawah Rp 3.000.000/bulan</li>
                            <li><strong>Sedang:</strong> Rp 3-6 juta/bulan</li>
                            <li><strong>Tinggi:</strong> Di atas Rp 6.000.000/bulan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize option cards
            const optionCards = document.querySelectorAll('.option-card');
            const hiddenInputs = {};
            const previews = {};
            const previewContainers = {};
            
            // Set up data structures
            ['ipk', 'penghasilan', 'tanggungan', 'status'].forEach(field => {
                hiddenInputs[field] = document.getElementById(field);
                previews[field] = document.getElementById(`preview-${field}`);
                previewContainers[field] = document.getElementById(`preview-${field}-container`);
                
                // Restore old values if any
                if (hiddenInputs[field].value) {
                    selectOption(field, hiddenInputs[field].value);
                }
            });
            
            // Option Card Selection
            optionCards.forEach(card => {
                card.addEventListener('click', function() {
                    const field = this.getAttribute('data-field');
                    const value = this.getAttribute('data-value');
                    
                    selectOption(field, value);
                    validateForm();
                });
            });
            
            function selectOption(field, value) {
                // Remove active class from all cards in same field
                document.querySelectorAll(`.option-card[data-field="${field}"]`).forEach(c => {
                    c.classList.remove('active');
                });
                
                // Add active class to selected card
                const selectedCard = document.querySelector(`.option-card[data-field="${field}"][data-value="${value}"]`);
                if (selectedCard) {
                    selectedCard.classList.add('active');
                }
                
                // Set hidden input value
                hiddenInputs[field].value = value;
                
                // Update preview
                updatePreview(field, value);
            }
            
            function updatePreview(field, value) {
                if (previews[field]) {
                    previews[field].textContent = value;
                    
                    // Add appropriate classes based on field and value
                    previewContainers[field].className = 'preview-item';
                    
                    if (field === 'ipk') {
                        previewContainers[field].classList.add(
                            value === 'Tinggi' ? 'option-ipk-tinggi' :
                            value === 'Sedang' ? 'option-ipk-sedang' : 'option-ipk-rendah'
                        );
                    } else if (field === 'penghasilan') {
                        previewContainers[field].classList.add(
                            value === 'Rendah' ? 'option-penghasilan-rendah' :
                            value === 'Sedang' ? 'option-penghasilan-sedang' : 'option-penghasilan-tinggi'
                        );
                    } else if (field === 'tanggungan') {
                        previewContainers[field].classList.add(
                            value === 'Sedikit' ? 'option-tanggungan-sedikit' : 'option-tanggungan-banyak'
                        );
                    } else if (field === 'status') {
                        previewContainers[field].classList.add(
                            value === 'Layak' ? 'option-status-layak' : 'option-status-tidak-layak'
                        );
                    }
                }
            }
            
            // Form validation
            function validateForm() {
                const fields = ['ipk', 'penghasilan', 'tanggungan', 'status'];
                const submitBtn = document.getElementById('submitBtn');
                let isValid = true;
                
                fields.forEach(field => {
                    if (!hiddenInputs[field].value) {
                        isValid = false;
                    }
                });
                
                submitBtn.disabled = !isValid;
                
                if (!isValid) {
                    submitBtn.innerHTML = '<i class="bi bi-exclamation-circle"></i> Lengkapi Data';
                    submitBtn.classList.add('btn-secondary');
                    submitBtn.classList.remove('btn-primary-custom');
                } else {
                    submitBtn.innerHTML = '<i class="bi bi-save"></i> Simpan Data';
                    submitBtn.classList.remove('btn-secondary');
                    submitBtn.classList.add('btn-primary-custom');
                }
            }
            
            // Form submission with SweetAlert
            document.getElementById('trainingForm').addEventListener('submit', function(e) {
                const fields = ['ipk', 'penghasilan', 'tanggungan', 'status'];
                let missingFields = [];
                
                fields.forEach(field => {
                    if (!hiddenInputs[field].value) {
                        missingFields.push(field);
                    }
                });
                
                if (missingFields.length > 0) {
                    e.preventDefault();
                    
                    Swal.fire({
                        title: 'Data Belum Lengkap',
                        html: `
                            <div class="text-start">
                                <p>Silakan lengkapi field berikut:</p>
                                <ul class="small">
                                    ${missingFields.map(field => {
                                        let label = '';
                                        switch(field) {
                                            case 'ipk': label = 'IPK'; break;
                                            case 'penghasilan': label = 'Penghasilan'; break;
                                            case 'tanggungan': label = 'Tanggungan'; break;
                                            case 'status': label = 'Status'; break;
                                        }
                                        return `<li><strong>${label}</strong></li>`;
                                    }).join('')}
                                </ul>
                            </div>
                        `,
                        icon: 'warning',
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#64748b'
                    });
                    
                    return;
                }
                
                // Show loading state
                const submitBtn = document.getElementById('submitBtn');
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Menyimpan...';
                submitBtn.disabled = true;
                
                // Allow form to submit normally
            });
            
            // Initialize form validation
            validateForm();
            
            // Add keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    window.location.href = "{{ url('/training') }}";
                }
            });
            
            // Show success message if redirected from store
            @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#10b981',
                timer: 3000,
                timerProgressBar: true
            }).then(() => {
                window.location.href = "{{ url('/training') }}";
            });
            @endif
        });
    </script>
</body>
</html>