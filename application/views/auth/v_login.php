<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Primaya Hospital</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets-tamplate/img/logo-primaya.png'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @font-face {
            font-family: 'Euclid Circular B';
            src: url('<?php echo base_url("assets-tamplate/Euclid Circular B Bold.ttf"); ?>') format('truetype');
            font-weight: 700;
            font-style: normal;
        }
    </style>

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --blue-deep: #0a4fa8;
            --blue-mid: #1796ff;
            --blue-light: #e8f3ff;
            --blue-accent: #4bb8f5;
            --white: #ffffff;
            --gray-soft: #f5f8fc;
            --gray-text: #64748b;
            --text-dark: #1a2540;
            --shadow-card: 0 30px 80px rgba(10, 79, 168, 0.18), 0 4px 20px rgba(10, 79, 168, 0.10);
            --shadow-btn: 0 8px 28px rgba(23, 150, 255, 0.45);
            --radius-card: 24px;
            --radius-input: 12px;
        }

        body {
            font-family: 'Euclid Circular B', sans-serif;
            background: #0d1b35;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* ── Animated background ── */
        .bg-scene {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
        }

        .bg-scene::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 30%, rgba(23, 150, 255, 0.22) 0%, transparent 65%),
                radial-gradient(ellipse 60% 50% at 80% 70%, rgba(10, 79, 168, 0.30) 0%, transparent 60%),
                radial-gradient(ellipse 100% 80% at 50% 50%, #0d1b35 30%, #0a2050 100%);
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: 0.35;
            animation: drift 12s ease-in-out infinite alternate;
        }

        .orb-1 {
            width: 520px;
            height: 520px;
            background: radial-gradient(circle, #1796ff, #0a4fa8);
            top: -120px;
            left: -100px;
            animation-duration: 14s;
        }

        .orb-2 {
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, #4bb8f5, #1796ff);
            bottom: -80px;
            right: -60px;
            animation-duration: 10s;
            animation-delay: -4s;
        }

        .orb-3 {
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, #0a4fa8, #0d1b35);
            top: 50%;
            left: 60%;
            animation-duration: 18s;
            animation-delay: -8s;
        }

        @keyframes drift {
            0% {
                transform: translate(0, 0) scale(1);
            }

            100% {
                transform: translate(30px, 20px) scale(1.06);
            }
        }

        /* Grid dots pattern */
        .bg-grid {
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle, rgba(255, 255, 255, 0.06) 1px, transparent 1px);
            background-size: 36px 36px;
        }

        /* ── Layout ── */
        .page-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 480px;
            padding: 24px;
            animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) both;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(32px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Card ── */
        .card {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-card);
            overflow: hidden;
            box-shadow: var(--shadow-card);
        }

        /* Top accent bar */
        .card-accent {
            height: 5px;
            background: linear-gradient(90deg, #0a4fa8 0%, #1796ff 50%, #4bb8f5 100%);
        }

        /* Card body */
        .card-body {
            padding: 44px 44px 40px;
        }

        /* ── Header ── */
        .header {
            text-align: center;
            margin-bottom: 36px;
        }

        .logo-wrap {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: var(--blue-light);
            margin-bottom: 20px;
            position: relative;
        }

        /* Placeholder logo icon (replace with actual img) */
        .logo-wrap svg {
            width: 44px;
            height: 44px;
        }

        .logo-wrap img {
            width: 100%;
            max-width: 64px;
            height: auto;
            object-fit: contain;
        }

        .hospital-name {
            font-family: 'Euclid Circular B', sans-serif;
            font-size: 22px;
            font-weight: 600;
            color: var(--text-dark);
            letter-spacing: -0.3px;
            line-height: 1.2;
        }

        .hospital-sub {
            font-size: 13px;
            color: var(--gray-text);
            margin-top: 4px;
            font-weight: 400;
            letter-spacing: 0.4px;
        }

        /* ── Divider label ── */
        .section-label {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 24px;
        }

        .section-label::before,
        .section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e2e8f0;
        }

        .section-label span {
            font-size: 12px;
            font-weight: 600;
            color: var(--blue-mid);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        /* ── Form ── */
        .form-group {
            margin-bottom: 16px;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: #475569;
            letter-spacing: 0.5px;
            margin-bottom: 7px;
            text-transform: uppercase;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            display: flex;
            align-items: center;
            transition: color 0.2s;
        }

        .form-control {
            width: 100%;
            padding: 13px 14px 13px 44px;
            border: 1.5px solid #e2e8f0;
            border-radius: var(--radius-input);
            font-family: 'Euclid Circular B', sans-serif;
            font-size: 14.5px;
            color: var(--text-dark);
            background: #fafbff;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .form-control::placeholder {
            color: #b0bdd0;
        }

        .form-control:focus {
            border-color: var(--blue-mid);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(23, 150, 255, 0.12);
        }

        .form-control:focus+.input-icon,
        .input-wrap:focus-within .input-icon {
            color: var(--blue-mid);
        }

        /* reorder icon to appear above input in DOM but positioned correctly */
        .input-wrap .form-control {
            order: 2;
        }

        .input-wrap .input-icon {
            order: 1;
            pointer-events: none;
        }

        /* Toggle password */
        .toggle-pw {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #94a3b8;
            display: flex;
            align-items: center;
            padding: 0;
            transition: color 0.2s;
        }

        .toggle-pw:hover {
            color: var(--blue-mid);
        }

        /* ── Login button ── */
        .btn-login {
            width: 100%;
            padding: 14px;
            margin-top: 8px;
            background: linear-gradient(135deg, #0a4fa8 0%, #1796ff 60%, #4bb8f5 100%);
            background-size: 200% 200%;
            background-position: left center;
            border: none;
            border-radius: 50px;
            color: #fff;
            font-family: 'Euclid Circular B', sans-serif;
            font-size: 15px;
            box-shadow: var(--shadow-btn);
            transition: background-position 0.4s ease, transform 0.15s, box-shadow 0.2s;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            background-position: right center;
            transform: translateY(-2px);
            box-shadow: 0 12px 36px rgba(23, 150, 255, 0.55);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Button shimmer */
        .btn-login::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 60%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.18), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::after {
            left: 150%;
        }

        /* ── Footer ── */
        .card-footer-custom {
            border-top: 1px solid #f1f5f9;
            padding: 20px 44px;
            text-align: center;
            background: #fafbff;
        }

        .footer-link {
            font-size: 13px;
            color: var(--gray-text);
            text-decoration: none;
            font-weight: 400;
            transition: color 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .footer-link:hover {
            color: var(--blue-mid);
        }

        .footer-link svg {
            width: 14px;
            height: 14px;
        }

        /* ── Responsive ── */
        @media (max-width: 520px) {
            .card-body {
                padding: 32px 28px 28px;
            }

            .card-footer-custom {
                padding: 18px 28px;
            }
        }
    </style>
</head>

<body>

    <!-- Background scene -->
    <div class="bg-scene">
        <div class="bg-grid"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <!-- Card -->
    <div class="page-wrapper">
        <div class="card">
                <?php if ($this->session->flashdata('error')): ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops..!',
                                text: '<?= $this->session->flashdata('error') ?>'
                            });
                        });
                    </script>
                <?php endif; ?>
            <div class="card-accent"></div>

            <div class="card-body">

                <!-- Header -->
                <div class="header">
                    <div class="logo-wrap">
                        <img src="<?php echo base_url('assets-tamplate/img/logo-primaya.png'); ?>" alt="Logo Primaya">
                        <!-- <svg viewBox="0 0 44 44" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="19" y="6" width="6" height="32" rx="3" fill="#1796ff" />
                            <rect x="6" y="19" width="32" height="6" rx="3" fill="#0a4fa8" />
                        </svg> -->
                    </div>
                    <div class="hospital-name">Primaya Hospital Karawang</div>
                    <div class="hospital-sub">· Survey Kepuasan Pasien ·</div>
                </div>

                <!-- Label -->
                <div class="section-label">
                    <span>Masuk ke Akun</span>
                </div>

                <!-- Form -->
                <form class="login-form" action="<?= base_url('auth/login'); ?>" method="POST">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">

                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <div class="input-wrap">
                            <input
                                type="text"
                                id="username"
                                name="username"
                                class="form-control"
                                placeholder="Masukkan username Anda"
                                required
                                autocomplete="username">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-wrap">
                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan password Anda"
                                required
                                autocomplete="current-password">
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                </svg>
                            </span>
                            <button type="button" class="toggle-pw" onclick="togglePassword()" title="Tampilkan/sembunyikan password">
                                <svg id="eye-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">Masuk</button>

                </form>

            </div><!-- /.card-body -->

            <div class="card-footer-custom">
                <a href="https://primayahospital.com/rumah-sakit/karawang/" target="_blank" rel="noopener" class="footer-link">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z" />
                        <circle cx="12" cy="10" r="3" />
                    </svg>
                    Primaya Hospital Karawang
                </a>
            </div>

        </div><!-- /.card -->
    </div><!-- /.page-wrapper -->

    <script>
        function togglePassword() {
            const pw = document.getElementById('password');
            const icon = document.getElementById('eye-icon');
            const isHidden = pw.type === 'password';

            pw.type = isHidden ? 'text' : 'password';

            icon.innerHTML = isHidden ?
                `<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"/>
                   <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"/>
                   <line x1="1" y1="1" x2="23" y2="23"/>` :
                `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                   <circle cx="12" cy="12" r="3"/>`;
        }
    </script>

</body>

</html>