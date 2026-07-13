<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak QR Code - <?= htmlspecialchars($room->name) ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('assets-tamplate/img/logo-primaya.png'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome untuk ikon tombol cetak -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Library QR Code JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
        :root {
            --navy: #1a2744;
            --navy-light: #253561;
            --green: #16a34a;
            --amber: #d97706;
            --bg-gray: #f8fafc;
            --text-dark: #0f172a;
            --text-muted: #475569;
            --border: #cbd5e1;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-gray);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Container untuk tampilan layar & cetak (Rasio A5 Portrait) */
        .poster-container {
            background-color: #ffffff;
            width: 148mm;
            height: 210mm;
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 24px 20px;
            position: relative;
            overflow: hidden;
            page-break-inside: avoid;
        }

        /* Aksen dekoratif di sudut poster */
        .poster-container::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(22, 163, 74, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .poster-container::after {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(26, 39, 68, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Bagian Header */
        .header {
            text-align: center;
            margin-bottom: 12px;
        }

        .logo {
            max-width: 55px;
            height: auto;
            margin-bottom: 6px;
        }

        .hospital-name {
            font-size: 15px;
            font-weight: 800;
            color: var(--navy);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }

        .hospital-sub {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-muted);
            margin-top: 1px;
        }

        .divider {
            height: 2px;
            background: linear-gradient(90deg, transparent 10%, var(--navy) 50%, transparent 90%);
            width: 100%;
            margin: 10px 0;
            border-radius: 2px;
        }

        /* Bagian Konten Utama */
        .main-content {
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .cta-title {
            font-size: 16px;
            font-weight: 800;
            color: var(--navy);
            line-height: 1.3;
            max-width: 90%;
            margin-bottom: 4px;
        }

        .cta-subtitle {
            font-size: 12px;
            font-weight: 600;
            color: var(--green);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        /* Badge Ruangan */
        .room-badge {
            background-color: var(--navy);
            color: #ffffff;
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 16px;
            box-shadow: 0 4px 10px rgba(26, 39, 68, 0.12);
            display: inline-block;
        }

        /* QR Code Wrapper */
        .qr-wrapper {
            background: #ffffff;
            padding: 12px;
            border-radius: 16px;
            border: 2px solid var(--navy);
            display: inline-block;
            box-shadow: 0 6px 20px rgba(26, 39, 68, 0.06);
            margin-bottom: 16px;
            position: relative;
        }

        #qrcode {
            width: 160px;
            height: 160px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #qrcode img {
            width: 160px;
            height: 160px;
        }

        /* Petunjuk Cara Pengisian */
        .instructions {
            text-align: left;
            background-color: var(--bg-gray);
            border-radius: 12px;
            padding: 12px 18px;
            width: 100%;
            max-width: 380px;
            margin-bottom: 16px;
            border-left: 4px solid var(--green);
        }

        .instruction-item {
            font-size: 11px;
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 6px;
            display: flex;
            align-items: flex-start;
            line-height: 1.4;
        }

        .instruction-item:last-child {
            margin-bottom: 0;
        }

        .step-num {
            background-color: var(--navy);
            color: #ffffff;
            font-size: 9px;
            font-weight: 700;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 8px;
            margin-top: 1px;
            flex-shrink: 0;
        }

        /* Bagian Footer */
        .footer {
            text-align: center;
            border-top: 1px solid #e2e8f0;
            padding-top: 12px;
        }

        .footer-note {
            font-size: 10px;
            font-weight: 500;
            color: var(--text-muted);
            line-height: 1.4;
        }

        .footer-thankyou {
            font-size: 11px;
            font-weight: 700;
            color: var(--navy);
            margin-top: 4px;
        }

        /* Floating action buttons (hanya tampil di layar browser) */
        .action-bar {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            gap: 10px;
            z-index: 1000;
        }

        .btn-action {
            padding: 10px 16px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 13px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-print {
            background-color: var(--green);
            color: #ffffff;
        }

        .btn-print:hover {
            background-color: #15803d;
            transform: translateY(-2px);
        }

        .btn-close {
            background-color: var(--navy);
            color: #ffffff;
        }

        .btn-close:hover {
            background-color: #111a2e;
            transform: translateY(-2px);
        }

        /* CSS KHUSUS UNTUK CETAK/PRINT */
        @media print {
            @page {
                size: A5 portrait;
                margin: 0;
            }

            body {
                background-color: #ffffff;
                padding: 0;
                margin: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 210mm;
                width: 148mm;
            }

            .poster-container {
                border: none;
                box-shadow: none;
                width: 148mm;
                height: 210mm;
                padding: 24px 20px;
                border-radius: 0;
                margin: 0;
                overflow: hidden;
                page-break-inside: avoid;
            }

            .action-bar {
                display: none !important;
            }

            /* Paksa browser mencetak background color & border */
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        /* Responsif untuk layar HP kecil agar tidak terpotong */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            .poster-container {
                width: 100%;
                height: auto;
                aspect-ratio: 148/210;
                padding: 16px;
            }
        }
    </style>
</head>
<body>

    <div class="poster-container">
        <!-- Header -->
        <div class="header">
            <img src="<?= base_url('assets-tamplate/img/logo-primaya.png'); ?>" alt="Logo Primaya" class="logo">
            <div class="hospital-name">Primaya Hospital Karawang</div>
            <div class="hospital-sub">Mitra Terpercaya Menuju Sehat</div>
            <div class="divider"></div>
        </div>

        <!-- Konten Utama -->
        <div class="main-content">
            <h1 class="cta-title">Bantu Kami Meningkatkan Kualitas Pelayanan</h1>
            <h2 class="cta-subtitle">Survei Kepuasan Pasien</h2>

            <!-- Informasi Ruangan -->
            <div class="room-badge">
                <i class="fa-solid fa-location-dot" style="margin-right: 4px;"></i> 
                <?= htmlspecialchars($room->name) ?> &mdash; Lantai <?= htmlspecialchars($room->floor) ?>
            </div>

            <!-- Area QR Code -->
            <div class="qr-wrapper">
                <div id="qrcode"></div>
            </div>

            <!-- Petunjuk Pengisian -->
            <div class="instructions">
                <div class="instruction-item">
                    <span class="step-num">1</span>
                    <span>Buka kamera ponsel Anda atau aplikasi pemindai QR Code.</span>
                </div>
                <div class="instruction-item">
                    <span class="step-num">2</span>
                    <span>Pindai (scan) gambar QR Code di atas.</span>
                </div>
                <div class="instruction-item">
                    <span class="step-num">3</span>
                    <span>Isi kuisioner singkat kepuasan pelayanan.</span>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="footer-note">Umpan balik (feedback) Anda sangat kami butuhkan untuk selalu menjaga dan meningkatkan standar pelayanan rumah sakit kami.</p>
            <p class="footer-thankyou">Terima Kasih Atas Kunjungan & Partisipasi Anda</p>
        </div>
    </div>

    <!-- Tombol Aksi di Layar -->
    <div class="action-bar no-print">
        <button onclick="window.print()" class="btn-action btn-print">
            <i class="fa-solid fa-print"></i> Cetak Poster
        </button>
        <button onclick="window.close()" class="btn-action btn-close">
            <i class="fa-solid fa-xmark"></i> Tutup
        </button>
    </div>

    <script>
        // Inisialisasi URL Target
        var surveyUrl = '<?= base_url("survey/form/" . $room->slug); ?>';

        // Render QR Code dengan opsi ukuran A5 yang optimal
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            text: surveyUrl,
            width: 160,
            height: 160,
            colorDark: "#1a2744", // Sesuai warna navy utama
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });

        // Tunggu gambar QR Code selesai ter-render sepenuhnya sebelum memicu print
        window.addEventListener('load', function() {
            setTimeout(function() {
                window.print();
            }, 500); // Penundaan 500ms agar QR selesai digambar secara visual
        });
    </script>

</body>
</html>
