<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistem Beasiswa</title>

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
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --input-border: #d1d5db;
            --input-focus: #2563eb;
            --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --card-shadow-hover: 0 20px 40px -10px rgba(0, 0, 0, 0.15);
        }

        body {
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            margin: 0;
        }

        /* Login Container */
        .login-container {
            width: 100%;
            max-width: 440px;
            margin: 0 auto;
        }

        /* Login Card */
        .login-card {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-card:hover {
            box-shadow: var(--card-shadow-hover);
            transform: translateY(-4px);
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-color), var(--success-color));
        }

        /* Logo Section */
        .login-logo {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-icon {
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, var(--primary-color), var(--success-color));
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            color: white;
            font-size: 2rem;
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.25);
            transform: rotate(-5deg);
        }

        .login-title {
            color: #1f2937;
            font-weight: 700;
            margin-bottom: 0.5rem;
            font-size: 1.75rem;
            letter-spacing: -0.025em;
        }

        .login-subtitle {
            color: var(--secondary-color);
            font-size: 0.95rem;
            line-height: 1.5;
            max-width: 300px;
            margin: 0 auto;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            display: block;
        }

        .input-wrapper {
            position: relative;
        }

        .form-control-custom {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #1f2937;
            background-color: white;
            border: 2px solid var(--input-border);
            border-radius: 10px;
            transition: all 0.2s ease;
            height: 52px;
            font-weight: 400;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            background-color: white;
        }

        .form-control-custom::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-color);
            font-size: 1.1rem;
            z-index: 10;
            transition: color 0.2s ease;
        }

        .form-control-custom:focus + .input-icon {
            color: var(--primary-color);
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--secondary-color);
            cursor: pointer;
            font-size: 1.1rem;
            padding: 0.25rem;
            transition: color 0.2s ease;
            z-index: 10;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        /* Checkbox */
        .form-check-custom {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .form-check-input-custom {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 2px solid var(--input-border);
            background-color: white;
            cursor: pointer;
            position: relative;
            appearance: none;
            -webkit-appearance: none;
            transition: all 0.2s ease;
        }

        .form-check-input-custom:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .form-check-input-custom:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 0.75rem;
            font-weight: bold;
        }

        .form-check-label-custom {
            color: #4b5563;
            font-size: 0.875rem;
            cursor: pointer;
            user-select: none;
        }

        /* Button */
        .btn-login {
            width: 100%;
            padding: 1rem;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, var(--primary-color), #1d4ed8);
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-top: 2rem;
            letter-spacing: 0.025em;
            height: 52px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .btn-login:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Alert */
        .alert-custom {
            border-radius: 10px;
            padding: 1rem 1.25rem;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            border: 1px solid;
            background-color: white;
        }

        .alert-danger {
            border-color: #fca5a5;
            background-color: #fef2f2;
            color: #991b1b;
        }

        .alert-success {
            border-color: #86efac;
            background-color: #f0fdf4;
            color: #166534;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 2.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }

        .footer-text {
            color: #6b7280;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                padding: 2rem;
            }
            
            .logo-icon {
                width: 64px;
                height: 64px;
                font-size: 1.75rem;
            }
            
            .login-title {
                font-size: 1.5rem;
            }
            
            .form-control-custom {
                padding: 0.875rem 0.875rem 0.875rem 2.75rem;
                height: 48px;
            }
            
            .input-icon {
                left: 0.875rem;
            }
            
            .password-toggle {
                right: 0.875rem;
            }
        }

        /* Animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.6s ease-out;
        }
    </style>
</head>
<body>
    <!-- Login Container -->
    <div class="login-container animate-slide-in">
        <!-- Login Card -->
        <div class="login-card">
            <!-- Logo Section -->
            <div class="login-logo">
                <div class="logo-icon">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h1 class="login-title">Sistem Beasiswa</h1>
                <p class="login-subtitle">
                    Panel Administrator • Klasifikasi Naive Bayes
                </p>
            </div>

            <!-- Error Alert -->
            @if(session('error'))
            <div class="alert alert-danger alert-custom">
                <i class="bi bi-exclamation-triangle"></i>
                <div>{{ session('error') }}</div>
            </div>
            @endif

            @if(session('success'))
            <div class="alert alert-success alert-custom">
                <i class="bi bi-check-circle"></i>
                <div>{{ session('success') }}</div>
            </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" 
                               id="email"
                               name="email" 
                               class="form-control-custom"
                               placeholder="example@email.com"
                               value="{{ old('email') }}"
                               required>
                    </div>
                    @error('email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <span class="input-icon">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" 
                               id="password"
                               name="password" 
                               class="form-control-custom"
                               placeholder="Masukkan password"
                               required>
                        <button type="button" class="password-toggle" id="passwordToggle">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-check-custom">
                    <input type="checkbox" 
                           class="form-check-input-custom" 
                           id="remember"
                           name="remember">
                    <label class="form-check-label-custom" for="remember">
                        Ingat saya
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login" id="loginButton">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Masuk ke Dashboard
                </button>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                <p class="footer-text">
                    <i class="bi bi-shield-check"></i>
                    Sistem Klasifikasi Beasiswa &copy; {{ date('Y') }}
                </p>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');
            const loginButton = document.getElementById('loginButton');

            // Password toggle functionality
            passwordToggle.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle eye icon
                const icon = this.querySelector('i');
                if (type === 'text') {
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                    this.setAttribute('title', 'Sembunyikan password');
                } else {
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                    this.setAttribute('title', 'Tampilkan password');
                }
            });

            // Form validation
            form.addEventListener('submit', function(e) {
                const email = emailInput.value.trim();
                const password = passwordInput.value.trim();

                if (!email || !password) {
                    e.preventDefault();
                    
                    Swal.fire({
                        title: 'Data Belum Lengkap',
                        text: 'Silakan isi email dan password dengan benar',
                        icon: 'warning',
                        confirmButtonText: 'Mengerti',
                        confirmButtonColor: '#64748b',
                        background: '#ffffff',
                        backdrop: 'rgba(0,0,0,0.1)'
                    });
                } else {
                    // Show loading state
                    loginButton.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
                    loginButton.disabled = true;
                }
            });

            // Add focus effects
            const inputs = [emailInput, passwordInput];
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    const icon = this.parentElement.querySelector('.input-icon i');
                    icon.style.color = 'var(--primary-color)';
                });
                
                input.addEventListener('blur', function() {
                    const icon = this.parentElement.querySelector('.input-icon i');
                    icon.style.color = 'var(--secondary-color)';
                });
            });

            // Enter key to submit
            form.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    form.dispatchEvent(new Event('submit'));
                }
            });

            // Show welcome message
            @if(!session('error') && !session('success'))
            setTimeout(() => {
                Swal.fire({
                    title: 'Selamat Datang',
                    html: `
                        <div class="text-start">
                            <p>Silakan login untuk mengakses Panel Administrator Sistem Beasiswa.</p>
                            <div class="alert alert-info small mt-2 p-2 rounded">
                                <i class="bi bi-info-circle me-1"></i>
                                Gunakan kredensial admin yang telah disediakan
                            </div>
                        </div>
                    `,
                    icon: 'info',
                    confirmButtonText: 'Mulai Login',
                    confirmButtonColor: '#2563eb',
                    background: '#ffffff',
                    backdrop: 'rgba(0,0,0,0.1)'
                });
            }, 800);
            @endif
        });
    </script>
</body>
</html>