<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIP SMKN 1 Selakau Timur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --accent-color: #224abe;
            --text-muted: #6c757d;
        }

        body {
            font-family: 'Outfit', sans-serif;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .login-wrapper {
            height: 100vh;
            display: flex;
        }

        /* Sisi Kiri - Visual */
        .login-visual {
            flex: 1.2;
            position: relative;
            background: url('/assets/img/login_bg.png') no-repeat center center;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            padding: 60px;
        }

        .login-visual::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(78, 115, 223, 0.8) 0%, rgba(34, 74, 190, 0.6) 100%);
        }

        .visual-content {
            position: relative;
            z-index: 1;
            max-width: 500px;
            animation: fadeInBlur 1.2s ease-out;
        }

        .visual-content h1 {
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .visual-content p {
            font-size: 1.2rem;
            opacity: 0.9;
            font-weight: 300;
        }

        /* Sisi Kanan - Form */
        .login-form-container {
            flex: 1;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            z-index: 2;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            animation: slideInRight 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .login-header {
            margin-bottom: 35px;
        }

        .login-header h2 {
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 8px;
        }

        .login-header p {
            color: var(--text-muted);
        }

        .form-label {
            font-weight: 600;
            font-size: 0.9rem;
            color: #444;
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
            color: var(--text-muted);
        }

        .form-control {
            border-left: none;
            padding: 12px;
            border-radius: 0 10px 10px 0 !important;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .form-control:focus {
            background-color: white;
            box-shadow: none;
            border-color: var(--accent-color);
        }

        .input-group:focus-within .input-group-text {
            border-color: var(--accent-color);
            color: var(--accent-color);
        }

        .input-group-text {
            border-radius: 10px 0 0 10px !important;
        }

        .btn-login {
            background: linear-gradient(to right, var(--primary-color), var(--accent-color));
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-weight: 600;
            color: white;
            width: 100%;
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(74, 20, 140, 0.3);
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(74, 20, 140, 0.4);
            color: white;
        }

        .school-info {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        /* Animations */
        @keyframes fadeInBlur {
            from { opacity: 0; filter: blur(10px); transform: translateY(20px); }
            to { opacity: 1; filter: blur(0); transform: translateY(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .login-visual {
                display: none;
            }
            body {
                overflow: auto;
            }
            .login-wrapper {
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            }
            .login-form-container {
                background: transparent;
                height: 100vh;
            }
            .login-card {
                background: white;
                padding: 40px;
                border-radius: 20px;
                box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Left Side: Visual -->
        <div class="login-visual">
            <div class="visual-content text-center text-lg-start">
                <h1>Sistem Informasi Perpustakaan</h1>
                <p>Membuka jendela dunia melalui literasi digital yang modern dan terintegrasi.</p>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="login-form-container">
            <div class="login-card">
                <div class="login-header d-flex align-items-center mb-4">
                    <img src="/assets/img/logo-smkn1seltim.png" alt="Logo Sekolah" class="me-3" style="width: 60px; height: auto;">
                    <div class="text-start">
                        <h2 class="mb-0 fs-4">SMKN 1 SELAKAU TIMUR</h2>
                        <p class="mb-0 small text-muted">Sistem Informasi Perpustakaan</p>
                    </div>
                </div>

                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="/login" method="POST">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="username" class="form-label text-uppercase tracking-wider">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username" required value="<?= old('username') ?>" autofocus>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label text-uppercase tracking-wider">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-login">
                        <span>MASUK SEKARANG</span>
                        <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
