<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Training - Sistem Beasiswa</title>

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

        /* Current Data Styles */
        .current-data-card {
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 1.5rem;
            background: white;
            box-shadow: var(--card-shadow);
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--warning-color);
        }

        .current-data-title {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .data-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .data-item {
            text-align: center;
            padding: 1rem;
            border-radius: 0.375rem;
            background-color: #f8fafc;
        }

        .data-label {
            font-size: 0.75rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .data-value {
            font-weight: 600;
            font-size: 1rem;
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

        .btn-warning-custom {
            background-color: var(--warning-color);
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

        .btn-warning-custom:hover {
            background-color: #d97706;
            transform: translateY(-1px);
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
            margin-bottom: 1.5rem;
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
            transition: all 0.3s ease;
        }

        .preview-item.changed {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.02); }
            100% { transform: scale(1); }
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

        /* Responsive */
        @media (max-width: 768px) {
            .option-grid {
                grid-template-columns: 1fr;
            }
            
            .data-grid,
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
                        <i class="bi bi-pencil-square"></i>
                        Edit Data Training
                    </h1>
                    <p class="header-subtitle">
                        ID: <strong>#{{ $data->id }}</strong> 
                        @if($data->updated_at)
                            • Terakhir diubah: {{ \Carbon\Carbon::parse($data->updated_at)->format('d/m/Y H:i') }}
                        @endif
                    </p>
                </div>
                <a href="{{ url('/training') }}" class="btn btn-outline-custom">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Current Data -->
        <div class="current-data-card">
            <h5 class="current-data-title">
                <i class="bi bi-database"></i> Data Saat Ini
            </h5>
            <div class="data-grid">
                <div class="data-item option-ipk-{{ strtolower($data->ipk) }}">
                    <div class="data-label">IPK</div>
                    <div class="data-value">{{ $data->ipk }}</div>
                </div>
                <div class="data-item option-penghasilan-{{ strtolower($data->penghasilan) }}">
                    <div class="data-label">Penghasilan</div>
                    <div class="data-value">{{ $data->penghasilan }}</div>
                </div>
                <div class="data-item option-tanggungan-{{ strtolower($data->tanggungan) }}">
                    <div class="data-label">Tanggungan</div>
                    <div class="data-value">{{ $data->tanggungan }}</div>
                </div>
                <div class="data-item option-status-{{ strtolower($data->status) }}">
                    <div class="data-label">Status</div>
                    <div class="data-value">{{ $data->status }}</div>
                </div>
            </div>
        </div>

        <!-- Warning Alert -->
        <div class="alert alert-warning alert-custom">
            <i class="bi bi-exclamation-triangle"></i>
            <div>
                <strong>Perhatian:</strong> Perubahan data training akan mempengaruhi akurasi model klasifikasi. Pastikan data yang diupdate sudah benar.
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
                Form Edit Data
            </div>
            
            <div class="form-card-body">
                <form action="{{ url('/training/' . $data->id) }}" method="POST" id="editForm">
                    @csrf
                    @method('PUT')

                    <!-- IPK Field -->
                    <div class="mb-4">
                        <label class="form-label">
                            <i class="bi bi-mortarboard"></i>
                            Indeks Prestasi Kumulatif (IPK)
                        </label>
                        <span class="form-hint">Pilih kategori IPK berdasarkan nilai akhir</span>
                        
                        <div class="option-grid">
                            <div class="option-card option-ipk-rendah {{ $data->ipk == 'Rendah' ? 'active' : '' }}" 
                                 data-value="Rendah" data-field="ipk">
                                <div class="option-icon">
                                    <i class="bi bi-emoji-frown"></i>
                                </div>
                                <div class="option-label">Rendah</div>
                                <div class="option-description">&lt; 2.75</div>
                            </div>
                            
                            <div class="option-card option-ipk-sedang {{ $data->ipk == 'Sedang' ? 'active' : '' }}" 
                                 data-value="Sedang" data-field="ipk">
                                <div class="option-icon">
                                    <i class="bi bi-emoji-neutral"></i>
                                </div>
                                <div class="option-label">Sedang</div>
                                <div class="option-description">2.75 - 3.50</div>
                            </div>
                            
                            <div class="option-card option-ipk-tinggi {{ $data->ipk == 'Tinggi' ? 'active' : '' }}" 
                                 data-value="Tinggi" data-field="ipk">
                                <div class="option-icon">
                                    <i class="bi bi-emoji-smile"></i>
                                </div>
                                <div class="option-label">Tinggi</div>
                                <div class="option-description">&gt; 3.50</div>
                            </div>
                        </div>
                        <input type="hidden" name="ipk" id="ipk" value="{{ $data->ipk }}" required>
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
                            <div class="option-card option-penghasilan-rendah {{ $data->penghasilan == 'Rendah' ? 'active' : '' }}" 
                                 data-value="Rendah" data-field="penghasilan">
                                <div class="option-icon">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div class="option-label">Rendah</div>
                                <div class="option-description">&lt; Rp 3 juta</div>
                            </div>
                            
                            <div class="option-card option-penghasilan-sedang {{ $data->penghasilan == 'Sedang' ? 'active' : '' }}" 
                                 data-value="Sedang" data-field="penghasilan">
                                <div class="option-icon">
                                    <i class="bi bi-cash-stack"></i>
                                </div>
                                <div class="option-label">Sedang</div>
                                <div class="option-description">Rp 3-6 juta</div>
                            </div>
                            
                            <div class="option-card option-penghasilan-tinggi {{ $data->penghasilan == 'Tinggi' ? 'active' : '' }}" 
                                 data-value="Tinggi" data-field="penghasilan">
                                <div class="option-icon">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <div class="option-label">Tinggi</div>
                                <div class="option-description">&gt; Rp 6 juta</div>
                            </div>
                        </div>
                        <input type="hidden" name="penghasilan" id="penghasilan" value="{{ $data->penghasilan }}" required>
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
                            <div class="option-card option-tanggungan-sedikit {{ $data->tanggungan == 'Sedikit' ? 'active' : '' }}" 
                                 data-value="Sedikit" data-field="tanggungan">
                                <div class="option-icon">
                                    <i class="bi bi-person-check"></i>
                                </div>
                                <div class="option-label">Sedikit</div>
                                <div class="option-description">1-3 orang</div>
                            </div>
                            
                            <div class="option-card option-tanggungan-banyak {{ $data->tanggungan == 'Banyak' ? 'active' : '' }}" 
                                 data-value="Banyak" data-field="tanggungan">
                                <div class="option-icon">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="option-label">Banyak</div>
                                <div class="option-description">&gt; 3 orang</div>
                            </div>
                        </div>
                        <input type="hidden" name="tanggungan" id="tanggungan" value="{{ $data->tanggungan }}" required>
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
                            <div class="option-card option-status-layak {{ $data->status == 'Layak' ? 'active' : '' }}" 
                                 data-value="Layak" data-field="status">
                                <div class="option-icon">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div class="option-label">Layak</div>
                                <div class="option-description">Diterima beasiswa</div>
                            </div>
                            
                            <div class="option-card option-status-tidak-layak {{ $data->status == 'Tidak Layak' ? 'active' : '' }}" 
                                 data-value="Tidak Layak" data-field="status">
                                <div class="option-icon">
                                    <i class="bi bi-x-circle"></i>
                                </div>
                                <div class="option-label">Tidak Layak</div>
                                <div class="option-description">Tidak diterima</div>
                            </div>
                        </div>
                        <input type="hidden" name="status" id="status" value="{{ $data->status }}" required>
                        @error('status')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="button" class="btn btn-outline-custom" id="resetBtn">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </button>
                        <div class="d-flex gap-2">
                            <a href="{{ url('/training') }}" class="btn btn-outline-custom">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary-custom" id="submitBtn">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Preview Card -->
        <div class="preview-card">
            <h5 class="preview-title">
                <i class="bi bi-eye"></i> Preview Perubahan
            </h5>
            <div class="preview-grid">
                <div class="preview-item" id="preview-ipk-container">
                    <div class="preview-label">IPK</div>
                    <div class="preview-value" id="preview-ipk">{{ $data->ipk }}</div>
                </div>
                <div class="preview-item" id="preview-penghasilan-container">
                    <div class="preview-label">Penghasilan</div>
                    <div class="preview-value" id="preview-penghasilan">{{ $data->penghasilan }}</div>
                </div>
                <div class="preview-item" id="preview-tanggungan-container">
                    <div class="preview-label">Tanggungan</div>
                    <div class="preview-value" id="preview-tanggungan">{{ $data->tanggungan }}</div>
                </div>
                <div class="preview-item" id="preview-status-container">
                    <div class="preview-label">Status</div>
                    <div class="preview-value" id="preview-status">{{ $data->status }}</div>
                </div>
            </div>
            <div class="alert alert-info mt-3 mb-0 py-2">
                <small>
                    <i class="bi bi-info-circle"></i>
                    Data yang berubah akan ditandai dengan animasi
                </small>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Store original values
            const originalValues = {
                ipk: "{{ $data->ipk }}",
                penghasilan: "{{ $data->penghasilan }}",
                tanggungan: "{{ $data->tanggungan }}",
                status: "{{ $data->status }}"
            };
            
            const currentValues = {...originalValues};
            const changedFields = new Set();
            
            // Initialize DOM elements
            const optionCards = document.querySelectorAll('.option-card');
            const hiddenInputs = {};
            const previews = {};
            const previewContainers = {};
            
            // Set up data structures
            ['ipk', 'penghasilan', 'tanggungan', 'status'].forEach(field => {
                hiddenInputs[field] = document.getElementById(field);
                previews[field] = document.getElementById(`preview-${field}`);
                previewContainers[field] = document.getElementById(`preview-${field}-container`);
                
                // Initialize preview styling
                updatePreview(field, originalValues[field]);
            });
            
            // Option Card Selection
            optionCards.forEach(card => {
                card.addEventListener('click', function() {
                    const field = this.getAttribute('data-field');
                    const value = this.getAttribute('data-value');
                    
                    selectOption(field, value);
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
                
                // Update hidden input
                hiddenInputs[field].value = value;
                currentValues[field] = value;
                
                // Check if value changed from original
                if (value !== originalValues[field]) {
                    changedFields.add(field);
                    previewContainers[field].classList.add('changed');
                } else {
                    changedFields.delete(field);
                    previewContainers[field].classList.remove('changed');
                }
                
                // Update preview
                updatePreview(field, value);
                
                // Update submit button state
                updateSubmitButton();
            }
            
            function updatePreview(field, value) {
                if (previews[field]) {
                    previews[field].textContent = value;
                    
                    // Update container styling
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
            
            function updateSubmitButton() {
                const submitBtn = document.getElementById('submitBtn');
                const hasChanges = changedFields.size > 0;
                
                submitBtn.disabled = !hasChanges;
                
                if (!hasChanges) {
                    submitBtn.innerHTML = '<i class="bi bi-check-circle"></i> Tidak Ada Perubahan';
                    submitBtn.classList.remove('btn-primary-custom');
                    submitBtn.classList.add('btn-outline-custom');
                } else {
                    submitBtn.innerHTML = `<i class="bi bi-save"></i> Simpan Perubahan (${changedFields.size})`;
                    submitBtn.classList.remove('btn-outline-custom');
                    submitBtn.classList.add('btn-primary-custom');
                }
            }
            
            // Reset functionality
            document.getElementById('resetBtn').addEventListener('click', function() {
                Swal.fire({
                    title: 'Reset Data?',
                    text: 'Semua perubahan akan dikembalikan ke nilai semula',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Reset',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#f59e0b',
                    cancelButtonColor: '#64748b'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Reset all fields to original values
                        Object.keys(originalValues).forEach(field => {
                            selectOption(field, originalValues[field]);
                        });
                        
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Data telah direset ke nilai semula',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                });
            });
            
            // Form submission with confirmation
            document.getElementById('editForm').addEventListener('submit', function(e) {
                if (changedFields.size === 0) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Tidak Ada Perubahan',
                        text: 'Anda belum melakukan perubahan pada data',
                        icon: 'info',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#64748b'
                    });
                    return;
                }
                
                e.preventDefault();
                
                Swal.fire({
                    title: 'Konfirmasi Perubahan',
                    html: `
                        <div class="text-start">
                            <p>Anda akan mengupdate data training berikut:</p>
                            <div class="bg-light p-3 rounded mb-3">
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <div class="text-muted small">IPK</div>
                                        <div class="fw-medium">${currentValues.ipk}</div>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <div class="text-muted small">Penghasilan</div>
                                        <div class="fw-medium">${currentValues.penghasilan}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-muted small">Tanggungan</div>
                                        <div class="fw-medium">${currentValues.tanggungan}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="text-muted small">Status</div>
                                        <div class="fw-medium">${currentValues.status}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-warning small mb-0">
                                <i class="bi bi-exclamation-triangle"></i>
                                Perubahan akan mempengaruhi model klasifikasi Naive Bayes.
                            </div>
                        </div>
                    `,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Update Data',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#2563eb',
                    cancelButtonColor: '#64748b'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Show loading state
                        const submitBtn = document.getElementById('submitBtn');
                        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Memproses...';
                        submitBtn.disabled = true;
                        
                        // Submit the form
                        this.submit();
                    }
                });
            });
            
            // Show success message if redirected from update
            @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                confirmButtonColor: '#10b981'
            }).then(() => {
                window.location.href = "{{ url('/training') }}";
            });
            @endif
            
            // Initialize submit button state
            updateSubmitButton();
            
            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    window.location.href = "{{ url('/training') }}";
                }
                if (e.ctrlKey && e.key === 's') {
                    e.preventDefault();
                    document.getElementById('submitBtn').click();
                }
                if (e.ctrlKey && e.key === 'r') {
                    e.preventDefault();
                    document.getElementById('resetBtn').click();
                }
            });
        });
    </script>
</body>
</html>