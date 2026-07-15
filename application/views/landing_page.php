<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey Kepuasan - Primaya Hospital Karawang</title>
    <link rel="icon" type="image/png" href="<?php echo base_url('assets-tamplate/img/logo-primaya.png'); ?>">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        header {
            background: white;
            padding: 15px 20px;
            box-shadow: 0 2px 8px rgba(0, 91, 127, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            height: 40px;
            display: flex;
            align-items: center;
            font-weight: bold;
            color: #005B7F;
            font-size: 18px;
        }

        .logo img {
            height: 40px;
            width: auto;
        }

        .contact-badge {
            background: #005B7F;
            color: white;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #005B7F 0%, #007399 100%);
            color: white;
            padding: 60px 20px;
            text-align: center;
            margin-top: 0;
        }

        .hero h1 {
            font-size: 28px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .hero p {
            font-size: 16px;
            margin-bottom: 25px;
            opacity: 0.95;
            line-height: 1.5;
        }

        .cta-button {
            background: #007399;
            color: white;
            padding: 14px 32px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(255, 107, 107, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .cta-button:hover {
            background: #005B7F;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 107, 107, 0.4);
        }

        /* Info Cards Section */
        .info-section {
            padding: 50px 20px;
            background: white;
        }

        .section-title {
            font-size: 24px;
            color: #005B7F;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background: white;
            border: 1px solid #E0E0E0;
            border-radius: 12px;
            padding: 25px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 91, 127, 0.15);
            border-color: #005B7F;
        }

        .card-icon {
            font-size: 36px;
            margin-bottom: 15px;
            color: #005B7F;
        }

        .card h3 {
            color: #005B7F;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .card p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        /* Hospital Info Section */
        .hospital-info {
            background: linear-gradient(to right, #f8f9fa, white);
            padding: 50px 20px;
        }

        .hospital-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
        }

        .hospital-text h2 {
            color: #005B7F;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .hospital-text p {
            color: #666;
            margin-bottom: 12px;
            line-height: 1.7;
        }

        .hospital-highlights {
            margin-top: 20px;
        }

        .highlight-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .highlight-icon {
            color: #005B7F;
            margin-right: 12px;
            font-weight: bold;
            font-size: 18px;
        }

        .highlight-text {
            color: #555;
            font-size: 14px;
        }

        /* Survey Explanation Section */
        .survey-section {
            background: white;
            padding: 50px 20px;
        }

        .survey-steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .step {
            text-align: center;
            padding: 20px;
        }

        .step-number {
            background: #005B7F;
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            margin: 0 auto 15px;
        }

        .step h3 {
            color: #005B7F;
            margin-bottom: 8px;
            font-size: 16px;
        }

        .step p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
        }

        /* Promo Section */
        .promo-section {
            background: linear-gradient(135deg, #005B7F 0%, #003E57 100%);
            color: white;
            padding: 50px 20px;
            position: relative;
            overflow: hidden;
        }

        .promo-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .promo-text h2 {
            font-size: 26px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .promo-text p {
            font-size: 16px;
            margin-bottom: 20px;
            opacity: 0.95;
        }

        .promo-highlight {
            background: rgba(255, 255, 255, 0.15);
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #FF6B6B;
            margin-bottom: 20px;
        }

        .promo-highlight strong {
            color: #FFD700;
            display: block;
            margin-bottom: 5px;
        }

        .promo-features {
            display: grid;
            gap: 15px;
        }

        .promo-feature {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .promo-feature-icon {
            font-size: 24px;
        }

        .promo-feature-text {
            font-size: 14px;
        }

        /* Footer */
        footer {
            /* background: #1a1a1a; */
            background: linear-gradient(135deg, #005B7F 0%, #003E57 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
            text-align: left;
        }

        .footer-col h4 {
            color: #ffffff;
            margin-bottom: 12px;
            font-size: 14px;
            font-weight: 600;
        }

        .footer-col p {
            font-size: 13px;
            color: #ffffff;
            line-height: 1.8;
        }

        .footer-col a {
            color: #ffffff;
            text-decoration: none;
        }

        .footer-col a:hover {
            text-decoration: underline;
        }

        .footer-bottom {
            border-top: 1px solid #ffffff;
            padding-top: 20px;
            font-size: 12px;
            color: #ffffff;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero {
                padding: 40px 20px;
            }

            .hero h1 {
                font-size: 24px;
            }

            .hospital-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .promo-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .promo-section {
                padding: 40px 20px;
            }

            .section-title {
                font-size: 20px;
            }

            .hospital-text h2 {
                font-size: 20px;
            }

            .promo-text h2 {
                font-size: 22px;
            }

            .contact-badge {
                font-size: 11px;
                padding: 5px 10px;
            }
        }

        /* Animation */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card,
        .step,
        .promo-highlight {
            animation: slideInUp 0.6s ease-out;
        }

        /* Modal untuk Survey */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .modal-content {
            background-color: white;
            margin: 10% auto;
            padding: 30px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            animation: slideInUp 0.3s ease;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            color: #005B7F;
            font-size: 22px;
        }

        .close-btn {
            font-size: 28px;
            font-weight: bold;
            color: #999;
            cursor: pointer;
            border: none;
            background: none;
        }

        .close-btn:hover {
            color: #005B7F;
        }

        .modal-body {
            display: grid;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            color: #005B7F;
            font-weight: 500;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #005B7F;
            box-shadow: 0 0 0 3px rgba(0, 91, 127, 0.1);
        }

        .rating-group {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .rating-btn {
            width: 45px;
            height: 45px;
            border: 1px solid #ddd;
            border-radius: 6px;
            background: white;
            cursor: pointer;
            font-weight: 600;
            color: #666;
            transition: all 0.3s ease;
        }

        .rating-btn:hover {
            border-color: #005B7F;
            color: #005B7F;
        }

        .rating-btn.active {
            background: #005B7F;
            color: white;
            border-color: #005B7F;
        }

        .submit-btn {
            background: #005B7F;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background: #003E57;
        }

        .success-message {
            display: none;
            text-align: center;
            padding: 30px;
            color: #27AE60;
            background: #EAFAF1;
            border-radius: 8px;
            border: 1px solid #27AE60;
        }

        .success-message.show {
            display: block;
            animation: slideInUp 0.3s ease;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="header-container">
            <div class="logo">
                <img src="<?= base_url('assets-tamplate/img/logo-primaya.png'); ?>" alt="Primaya Hospital" class="logo-img">
            </div>
            <div class="contact-badge">📞 1 500 007</div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Bergabunglah dalam Survey Kepuasan!</h1>
            <p>Suara Anda sangat penting bagi kami. Bantu kami meningkatkan kualitas lingkungan dan layanan dengan berbagi pengalaman Anda di Primaya Hospital Karawang</p>
            <button class="cta-button">Ikuti Survey Dengan Scan Barcode di Lokasi yang anda kunjungi!</button>
        </div>
    </section>

    <!-- Hospital Info Section -->
    <section class="hospital-info">
        <div class="container">
            <div class="hospital-content">
                <div class="hospital-text">
                    <h2>Tentang Primaya Hospital Karawang</h2>
                    <p>Primaya Hospital Karawang berdiri sejak April 2020. Primaya Hospital Karawang senantiasa mengedepankan keselamatan pasien serta mutu dan layanan berkualitas PRIMA. Primaya Hospital Karawang bertujuan untuk memenuhi kebutuhan kesehatan masyarakat, khususnya di Kabupaten Karawang dan sekitarnya. <br><br> Terletak 15 menit dari pintu tol Karawang Barat dan Karawang Timur, Primaya Hospital Karawang selalu siap melayani pasien dengan kapasitas awal 106 tempat tidur yang tersedia dan berbagai fasilitas medis lainnya. Primaya Hospital Karawang akan selalu mengembangkan fasilitas berkualitas lainnya sesuai kebutuhan masyarakat.</p>
                    <p><strong>Lokasi:</strong> Jl. Arteri Galuh Mas Kav. Komersil Galuh Mas Blok X, Telukjambe Timur, Karawang, Jawa Barat 41361</p>

                    <div class="hospital-highlights">
                        <div class="highlight-item">
                            <span class="highlight-icon">✓</span>
                            <span class="highlight-text"><strong>Layanan 24 Jam:</strong> Instalasi Gawat Darurat tersedia sepanjang waktu</span>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-icon">✓</span>
                            <span class="highlight-text"><strong>Layanan Unggulan:</strong> Pusat Ibu dan Anak, Trauma Center, dan Urologi</span>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-icon">✓</span>
                            <span class="highlight-text"><strong>Fasilitas Lengkap:</strong> Radiologi, Laboratorium, Farmasi, dan Area Parkir Luas</span>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-icon">✓</span>
                            <span class="highlight-text"><strong>Daftar Online:</strong> WhatsApp Chatbot <a href="https://wa.me/6282288889702" target="_blank">0822 8888 9702</a></span>
                        </div>
                    </div>
                </div>
                <div class="hospital-text">
                    <h2>Komitmen Kami</h2>
                    <p><strong>Slogan:</strong> "Here For You" - Selalu ada dan siap melayani</p>
                    <p><strong>Filosofi:</strong> Memberikan pelayanan kesehatan secara profesional dengan penuh kepedulian kepada setiap pasien dan keluarganya.</p>

                    <div class="hospital-highlights">
                        <div class="highlight-item">
                            <span class="highlight-icon">🎯</span>
                            <span class="highlight-text">Keselamatan dan kualitas mutu pasien adalah prioritas utama</span>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-icon">🎯</span>
                            <span class="highlight-text">Terakreditasi nasional oleh KARS</span>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-icon">🎯</span>
                            <span class="highlight-text">Melayani pasien pribadi, asuransi, BPJS, dan KIS</span>
                        </div>
                        <div class="highlight-item">
                            <span class="highlight-icon">🎯</span>
                            <span class="highlight-text">Jaringan terintegrasi dengan rumah sakit Primaya lainnya</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Survey Explanation Section -->
    <section class="survey-section">
        <div class="container">
            <h2 class="section-title">Apa itu Survey Kepuasan?</h2>
            <p style="text-align: center; color: #666; margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto;">
                Survey kepuasan adalah program kami untuk mendengarkan masukan berharga dari Anda tentang pengalaman selama berada di rumah sakit kami, sehingga kami dapat terus meningkatkan kualitas pelayanan.
            </p>

            <div class="survey-steps">
                <!-- <div class="step">
                    <div class="step-number">1</div>
                    <h3>Isi Biodata</h3>
                    <p>Berikan informasi dasar tentang diri Anda dan kunjungan Anda ke rumah sakit</p>
                </div> -->
                <div class="step">
                    <div class="step-number">1</div>
                    <h3>Berikan Rating</h3>
                    <p>Beri nilai terhadap berbagai aspek pelayanan yang Anda terima</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h3>Tulis Komentar</h3>
                    <p>Bagikan saran dan masukan Anda untuk perbaikan berkelanjutan</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h3>Selesai!</h3>
                    <p>Terima kasih atas partisipasi Anda dalam meningkatkan pelayanan kami</p>
                </div>
            </div>

            <div class="cards-grid">
                <div class="card">
                    <div class="card-icon">⏱️</div>
                    <h3>Cepat & Mudah</h3>
                    <p>Survey hanya membutuhkan waktu 1-2 menit untuk diselesaikan dengan pertanyaan yang jelas dan mudah dipahami</p>
                </div>
                <div class="card">
                    <div class="card-icon">🔒</div>
                    <h3>Privasi Terjaga</h3>
                    <p>Data pribadi Anda akan dijaga dengan ketat dan hanya digunakan untuk keperluan peningkatan pelayanan</p>
                </div>
                <div class="card">
                    <div class="card-icon">🎯</div>
                    <h3>Dampak Nyata</h3>
                    <p>Masukan Anda akan langsung kami analisis untuk perbaikan proses dan kualitas pelayanan kesehatan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Promo Section -->
    <!-- <section class="promo-section">
        <div class="container">
            <div class="promo-content">
                <div class="promo-text">
                    <h2>Berikut Promo Menarik di Primaya Hospital Karawang!</h2>
                    <p>Silahkan langsung mendaftarkan diri di Medical Check-up untuk mendapatkan penawaran istimewa!</p>

                    <div class="promo-highlight">
                        <strong>🎁 Kesempatan Menarik:</strong>
                        <p style="margin-top: 5px; margin-bottom: 0;">Setiap responden yang menyelesaikan survey akan mendapatkan voucher medical check-up senilai Rp 500.000 dan kesempatan memenangkan hadiah utama Medical Check-up Lengkap senilai Rp 5.000.000</p>
                    </div>
                </div>

                <div>
                    <div class="promo-features">
                        <div class="promo-feature">
                            <div class="promo-feature-icon">✨</div>
                            <div class="promo-feature-text">
                                <strong>Voucher Medical Check-up</strong><br>
                                Rp 500.000 untuk setiap peserta
                            </div>
                        </div>
                        <div class="promo-feature">
                            <div class="promo-feature-icon">🏆</div>
                            <div class="promo-feature-text">
                                <strong>Undian Berhadiah</strong><br>
                                Kesempatan memenangkan paket medis premium
                            </div>
                        </div>
                        <div class="promo-feature">
                            <div class="promo-feature-icon">📱</div>
                            <div class="promo-feature-text">
                                <strong>Proses Mudah</strong><br>
                                Ikuti survey online dalam 5-10 menit saja
                            </div>
                        </div>
                        <div class="promo-feature">
                            <div class="promo-feature-icon">🎯</div>
                            <div class="promo-feature-text">
                                <strong>Periode Terbatas</strong><br>
                                Buruan ikuti sebelum kesempatan ini berakhir
                            </div>
                        </div>
                    </div>

                    <button class="cta-button" onclick="openSurveyModal()" style="width: 100%; margin-top: 20px;">Ikuti Survey Sekarang</button>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-col">
                <h4>Informasi Kontak</h4>
                <p>
                    <strong>Telepon:</strong> (0267) 841-7777<br>
                    <strong>Call Center:</strong> 1 500 007<br>
                    <strong>WhatsApp:</strong> 0822 8888 9702<br>
                    <strong>Emergency:</strong> 1500-007
                </p>
            </div>
            <div class="footer-col">
                <h4>Jam Operasional</h4>
                <p>
                    <strong>IGD (Gawat Darurat):</strong> 24 Jam<br>
                    <strong>Poliklinik Umum:</strong> 07:00 - 21:00<br>
                    <strong>Jam Besuk:</strong><br>
                    11:00 - 13:00 WIB<br>
                    17:00 - 19:00 WIB
                </p>
            </div>
            <div class="footer-col">
                <h4>Alamat</h4>
                <p>
                    Jl. Arteri Galuh Mas Kav. Komersil Galuh Mas Blok X<br>
                    Telukjambe Timur, Karawang<br>
                    Jawa Barat 41361 <br>
                    <a href="https://maps.app.goo.gl/neVjkGpn88fYPzzA8"
                        target="_blank"
                        style="color:white; text-decoration:underline;">
                        Google Maps Primaya Hospital Karawang
                    </a>
                </p>
            </div>
            <div class="footer-col">
                <h4>Layanan Utama</h4>
                <p>
                    • Pusat Layanan Ibu & Anak<br>
                    • Trauma Center<br>
                    • Pusat Urologi<br>
                    • Medical Check-Up<br>
                    • Telemedicine
                </p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2020 - <?= date('Y') ?> Primaya Hospital Karawang. Semua hak dilindungi. | Kepercayaan Anda adalah Prioritas Kami</p>
        </div>
    </footer>

    <!-- Survey Modal -->
    <div id="surveyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Survey Kepuasan</h2>
                <button class="close-btn" onclick="closeSurveyModal()">&times;</button>
            </div>
            <div class="success-message" id="successMessage">
                <h3>✓ Terima Kasih!</h3>
                <p>Data survey Anda telah kami terima. Voucher medical check-up akan dikirim ke email Anda dalam 24 jam.</p>
            </div>
            <form id="surveyForm" class="modal-body" onsubmit="submitSurvey(event)">
                <div class="form-group">
                    <label for="name">Nama Lengkap *</label>
                    <input type="text" id="name" name="name" required placeholder="Masukkan nama Anda">
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required placeholder="example@email.com">
                </div>

                <div class="form-group">
                    <label for="phone">Nomor Telepon *</label>
                    <input type="tel" id="phone" name="phone" required placeholder="08xxxxxxxxxx">
                </div>

                <div class="form-group">
                    <label for="department">Departemen/Layanan yang Dikunjungi *</label>
                    <select id="department" name="department" required>
                        <option value="">-- Pilih Departemen --</option>
                        <option value="gawat-darurat">Gawat Darurat (IGD)</option>
                        <option value="poliklinik">Poliklinik Umum</option>
                        <option value="ibu-anak">Pusat Layanan Ibu & Anak</option>
                        <option value="trauma">Trauma Center</option>
                        <option value="urologi">Pusat Urologi</option>
                        <option value="rawat-inap">Rawat Inap</option>
                        <option value="laboratorium">Laboratorium</option>
                        <option value="radiologi">Radiologi</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Bagaimana pengalaman Anda secara keseluruhan? *</label>
                    <div class="rating-group">
                        <button type="button" class="rating-btn" onclick="selectRating(1, this)">1</button>
                        <button type="button" class="rating-btn" onclick="selectRating(2, this)">2</button>
                        <button type="button" class="rating-btn" onclick="selectRating(3, this)">3</button>
                        <button type="button" class="rating-btn" onclick="selectRating(4, this)">4</button>
                        <button type="button" class="rating-btn" onclick="selectRating(5, this)">5</button>
                    </div>
                    <small style="color: #999;">1 = Kurang Memuaskan, 5 = Sangat Memuaskan</small>
                    <input type="hidden" id="rating" name="rating" required value="">
                </div>

                <div class="form-group">
                    <label for="comments">Saran dan Masukan *</label>
                    <textarea id="comments" name="comments" required placeholder="Bagikan pengalaman dan saran Anda..." rows="4"></textarea>
                </div>

                <button type="submit" class="submit-btn">Kirim Survey</button>
            </form>
        </div>
    </div>

    <script>
        function openSurveyModal() {
            document.getElementById('surveyModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closeSurveyModal() {
            document.getElementById('surveyModal').style.display = 'none';
            document.body.style.overflow = 'auto';
            resetForm();
        }

        function selectRating(rating, element) {
            // Hapus kelas active dari semua tombol
            const buttons = element.parentElement.querySelectorAll('.rating-btn');
            buttons.forEach(btn => btn.classList.remove('active'));

            // Tambah kelas active ke tombol yang diklik
            element.classList.add('active');

            // Set nilai rating
            document.getElementById('rating').value = rating;
        }

        function submitSurvey(event) {
            event.preventDefault();

            // Validasi rating
            if (!document.getElementById('rating').value) {
                alert('Silakan berikan rating Anda');
                return;
            }

            // Ambil data form
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                department: document.getElementById('department').value,
                rating: document.getElementById('rating').value,
                comments: document.getElementById('comments').value,
                timestamp: new Date().toISOString()
            };

            // Simpan ke localStorage (untuk demo)
            const surveys = JSON.parse(localStorage.getItem('surveys') || '[]');
            surveys.push(formData);
            localStorage.setItem('surveys', JSON.stringify(surveys));

            console.log('Survey Data:', formData);

            // Tampilkan pesan sukses
            document.getElementById('surveyForm').style.display = 'none';
            document.getElementById('successMessage').classList.add('show');

            // Reset setelah 3 detik
            setTimeout(() => {
                closeSurveyModal();
            }, 3000);
        }

        function resetForm() {
            document.getElementById('surveyForm').style.display = 'block';
            document.getElementById('successMessage').classList.remove('show');
            document.getElementById('surveyForm').reset();

            // Hapus kelas active dari rating buttons
            const buttons = document.querySelectorAll('.rating-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            document.getElementById('rating').value = '';
        }

        // Tutup modal jika klik di luar konten
        window.onclick = function(event) {
            const modal = document.getElementById('surveyModal');
            if (event.target == modal) {
                closeSurveyModal();
            }
        }

        // Smooth scroll untuk tombol
        document.querySelectorAll('.cta-button').forEach(btn => {
            btn.addEventListener('click', function() {
                // Tombol sudah menjalankan function onclick
            });
        });
    </script>
</body>

</html>