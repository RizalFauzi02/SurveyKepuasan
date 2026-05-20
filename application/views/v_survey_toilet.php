<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surevi Kepuasan - Primaya Hospital Karawang</title>
  <link rel="icon" type="image/png" href="<?php echo base_url('assets-tamplate/img/logo-primaya.png'); ?>">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- css custom -->
  <style>
    .input-no-style {
      border: none;
      background: transparent;
      padding: 0;
      margin: 0;
      width: 100%;
      font-size: 16px;
      color: #ffffff;
      pointer-events: auto;
      font-weight: bold;
      /* biar tidak bisa diklik */
    }

    /* khusus lantai biar seperti badge */
    .badge-style {
      display: inline-block;
      background: #eee;
      padding: 5px 12px;
      border-radius: 20px;
      width: auto;
    }
  </style>


  <style>
    :root {
      --navy: #1a2744;
      --navy-light: #253561;
      --blue: #1d4ed8;
      --blue-light: #3b82f6;
      --red-1: #ef4444;
      --red-2: #f97316;
      --amber: #f59e0b;
      --green-4: #22c55e;
      --green-5: #16a34a;
      --bg: #ffffff;
      --text: #1a2744;
      --text-muted: #64748b;
      --border: #e2e8f0;
      --selected-bg: #1d4ed8;
      --selected-text: #ffffff;
      --option-bg: #f1f5ff;
      --option-text: #1d4ed8;
      --shadow: 0 4px 24px rgba(26, 39, 68, 0.10);
    }

    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: #f0f4ff;
      min-height: 100vh;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 24px 16px 80px;
    }

    .app {
      width: 100%;
      max-width: 480px;
      background: #fff;
      border-radius: 20px;
      box-shadow: var(--shadow);
      overflow: hidden;
      position: relative;
      min-height: 600px;
    }

    /* Language Selector */
    .lang-bar {
      display: flex;
      justify-content: flex-end;
      padding: 16px 20px 0;
      position: relative;
      z-index: 10;
    }

    .lang-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      border: 1.5px solid var(--border);
      background: #fff;
      border-radius: 10px;
      padding: 8px 14px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 14px;
      font-weight: 600;
      color: var(--navy);
      cursor: pointer;
      transition: border-color 0.2s, background 0.2s;
      min-width: 120px;
      justify-content: space-between;
    }

    .lang-btn:hover {
      border-color: var(--blue);
      background: #f1f5ff;
    }

    .lang-dropdown {
      position: absolute;
      top: 52px;
      right: 20px;
      background: #fff;
      border: 1.5px solid var(--border);
      border-radius: 12px;
      box-shadow: 0 8px 32px rgba(26, 39, 68, 0.13);
      overflow: hidden;
      display: none;
      z-index: 100;
      min-width: 140px;
    }

    .lang-dropdown.open {
      display: block;
    }

    .lang-option {
      padding: 11px 18px;
      font-size: 14px;
      font-weight: 600;
      color: var(--navy);
      cursor: pointer;
      transition: background 0.15s;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .lang-option:hover {
      background: #f1f5ff;
    }

    .lang-option.active {
      background: #1d4ed8;
      color: #fff;
    }

    /* Slides */
    .slides {
      position: relative;
    }

    .slide {
      display: none;
      padding: 24px 28px 32px;
      animation: fadeSlide 0.35s cubic-bezier(.4, 0, .2, 1);
    }

    .slide.active {
      display: block;
    }

    @keyframes fadeSlide {
      from {
        opacity: 0;
        transform: translateY(18px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Slide 1 - Location Info */
    .location-title {
      font-size: 13px;
      font-weight: 800;
      letter-spacing: 2px;
      color: var(--blue);
      text-transform: uppercase;
      text-align: center;
      margin-bottom: 28px;
    }

    .info-card {
      background: linear-gradient(135deg, #588dff 0%, #1d4ed8 100%);
      border-radius: 16px;
      padding: 24px 22px;
      color: #fff;
      margin-bottom: 28px;
    }

    .info-row {
      margin-bottom: 14px;

      last-child {
        margin-bottom: 0;
      }
    }

    .info-label {
      font-size: 10px;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.6);
      margin-bottom: 3px;
    }

    .info-value {
      font-size: 15px;
      font-weight: 700;
      color: #fff;
      line-height: 1.3;
    }

    .info-badge {
      display: inline-flex;
      align-items: center;
      background: rgba(255, 255, 255, 0.15);
      border-radius: 8px;
      padding: 3px 10px;
      font-size: 12px;
      font-weight: 700;
      color: #fff;
      margin-top: 4px;
    }

    .id-box {
      background: rgba(255, 255, 255, 0.12);
      border-radius: 10px;
      padding: 10px 14px;
      text-align: center;
      margin-top: 4px;
      font-size: 20px;
      font-weight: 800;
      letter-spacing: 2px;
      color: #fff;
    }

    /* Slide 2 - Rating */
    .question-label {
      font-size: 15px;
      font-weight: 500;
      color: var(--text-muted);
      margin-bottom: 4px;
    }

    .question-text {
      font-size: 20px;
      font-weight: 800;
      color: var(--navy);
      line-height: 1.35;
      margin-bottom: 30px;
    }

    .question-text span {
      color: var(--blue);
    }

    .rating-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 14px;
    }

    .rating-btn {
      width: 54px;
      height: 54px;
      border-radius: 50%;
      border: none;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 20px;
      font-weight: 800;
      color: #fff;
      cursor: pointer;
      transition: transform 0.18s, box-shadow 0.18s, filter 0.18s;
      position: relative;
      flex-shrink: 0;
    }

    .rating-btn:nth-child(1) {
      background: #ef4444;
    }

    .rating-btn:nth-child(2) {
      background: #f97316;
    }

    .rating-btn:nth-child(3) {
      background: #f59e0b;
    }

    .rating-btn:nth-child(4) {
      background: #22c55e;
    }

    .rating-btn:nth-child(5) {
      background: #16a34a;
    }

    .rating-btn:hover {
      transform: scale(1.12);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.18);
    }

    .rating-btn.selected {
      transform: scale(1.18);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.22);
      outline: 3px solid var(--navy);
      outline-offset: 2px;
    }

    .rating-labels {
      display: flex;
      justify-content: space-between;
      font-size: 11px;
      font-weight: 700;
      color: var(--text-muted);
      margin-top: 6px;
      padding: 0 4px;
      letter-spacing: 0.3px;
    }

    .label-bad {
      color: #ef4444;
    }

    .label-good {
      color: #16a34a;
    }

    /* Slide 3 - Checkbox */
    .options-list {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 28px;
      position: relative;
      z-index: 1;
    }

    .option-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 14px 18px;
      border-radius: 12px;
      border: 2px solid var(--border);
      background: var(--option-bg);
      color: var(--option-text);
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: border-color 0.18s, background 0.18s, color 0.18s, transform 0.12s;
      user-select: none;
      line-height: 1.4;
    }

    .option-item:hover {
      border-color: var(--blue-light);
      transform: translateX(3px);
    }

    .option-item.selected {
      background: var(--selected-bg);
      color: var(--selected-text);
      border-color: var(--selected-bg);
    }

    .check-icon {
      width: 22px;
      height: 22px;
      border-radius: 6px;
      border: 2px solid currentColor;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
      font-size: 13px;
      transition: background 0.18s;
      margin-left: 10px;
    }

    .option-item.selected .check-icon {
      background: rgba(255, 255, 255, 0.25);
      border-color: rgba(255, 255, 255, 0.5);
    }

    .hint-text {
      font-size: 12px;
      color: var(--text-muted);
      margin-bottom: 18px;
    }

    /* Buttons */
    .btn-primary {
      display: block;
      width: 100%;
      padding: 16px;
      background: var(--navy);
      color: #fff;
      border: none;
      border-radius: 14px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 16px;
      font-weight: 700;
      cursor: pointer;
      transition: background 0.2s, transform 0.12s;
      letter-spacing: 0.3px;
    }

    .btn-primary:hover {
      background: var(--blue);
      transform: translateY(-1px);
    }

    .btn-primary:active {
      transform: translateY(1px);
    }

    .btn-hint {
      text-align: center;
      font-size: 12px;
      color: var(--text-muted);
      margin-top: 10px;
    }

    /* Nav buttons */
    .nav-bar {
      position: fixed;
      bottom: 20px;
      right: 20px;
      display: flex;
      gap: 8px;
      z-index: 50;
    }

    .nav-btn {
      width: 42px;
      height: 42px;
      border-radius: 12px;
      background: #334155;
      color: #fff;
      border: none;
      font-size: 18px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.18s;
    }

    .nav-btn:hover {
      background: var(--blue);
    }

    .nav-btn:disabled {
      background: #cbd5e1;
      cursor: not-allowed;
    }

    /* Progress */
    .progress-bar {
      height: 3px;
      background: var(--border);
      position: relative;
      overflow: hidden;
    }

    .progress-fill {
      height: 100%;
      background: linear-gradient(90deg, #1d4ed8, #3b82f6);
      transition: width 0.4s cubic-bezier(.4, 0, .2, 1);
    }

    /* Success slide */
    .success-wrap {
      text-align: center;
      padding: 40px 28px;
    }

    .success-icon {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: linear-gradient(135deg, #22c55e, #16a34a);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 36px;
      margin: 0 auto 24px;
      box-shadow: 0 8px 24px rgba(22, 163, 74, 0.3);
      animation: popIn 0.5s cubic-bezier(.4, 0, .2, 1);
    }

    @keyframes popIn {
      from {
        transform: scale(0.5);
        opacity: 0;
      }

      to {
        transform: scale(1);
        opacity: 1;
      }
    }

    .success-title {
      font-size: 22px;
      font-weight: 800;
      color: var(--navy);
      margin-bottom: 10px;
    }

    .success-desc {
      font-size: 14px;
      color: var(--text-muted);
      line-height: 1.6;
    }

    /* CUSTOM RIZAL */
    #otherWrapper {
      display: none;
      margin-top: 12px;
      position: relative;
      z-index: 10;
      /* 🔥 biar di atas */
    }

    #inputOther {
      width: 100%;
      padding: 12px 14px;
      border-radius: 10px;
      border: 2px solid #e5e7eb;
      font-size: 14px;
      outline: none;
      background: #ffffff;
      position: relative;
      z-index: 11;
      color: #1d4ed8;
      /* lebih atas lagi */
    }

    #inputOther:focus {
      border-color: #3b82f6;
    }
  </style>
</head>

<body>

  <div class="app">
    <!-- Progress bar -->
    <div class="progress-bar">
      <div class="progress-fill" id="progressFill" style="width:22%"></div>
    </div>

    <!-- Language Bar -->
    <!-- <div class="lang-bar">
      <button class="lang-btn" id="langBtn" onclick="toggleLang()">
        <span id="langLabel">Bahasa</span>
        <span>&#8964;</span>
      </button>
      <div class="lang-dropdown" id="langDropdown">
        <div class="lang-option active" id="opt-id" onclick="setLang('id')">🇮🇩 Indonesia</div>
        <div class="lang-option" id="opt-en" onclick="setLang('en')">🇬🇧 English</div>
      </div>
    </div> -->
    <form id="formSurvey" method="post" action="<?= base_url('survey/save'); ?>" onsubmit="return false;">
      <div class="slides">

        <!-- Slide 1: Location Validator -->
        <div class="slide active" id="slide-1">
          <br><br><br>
          <div class="location-title" id="loc-title">SURVEI KEPUASAN</div>

          <div class="info-card">

            <div class="info-row">
              <div class="info-label" id="lbl-location">NAMA LOKASI</div>
              <input type="text" name="nama_lokasi"
                class="input-no-style"
                value="Toilet Umum Wanita"
                readonly>
            </div>

            <div class="info-row">
              <div class="info-label" id="lbl-floor">LANTAI</div>
              <input type="text" name="lantai"
                class="input-no-style"
                value="2"
                readonly>
            </div>

            <div class="info-row">
              <div class="info-label" id="lbl-facility-type">TIPE FASILITAS</div>
              <input type="text" name="tipe_fasilitas"
                class="input-no-style"
                value="Toilet Poli Eksekutif - Lantai 2"
                readonly>
            </div>

          </div>

          <button type="button" class="btn-primary" onclick="goSlide(2)">Selanjutnya</button>
          <div class="btn-hint" id="hint-1">Tekan Enter</div>
        </div>

        <!-- Slide 2: Rating -->
        <div class="slide" id="slide-2">
          <br><br><br>
          <div class="question-text" id="q-rating">
            Seberapa puas Bapak / Ibu terhadap fasilitas <span>Toilet</span> kami? <span style="color:#ef4444">*</span>
          </div>

          <div class="rating-row">
            <button type="button" class="rating-btn" onclick="selectRating(1)">1</button>
            <button type="button" class="rating-btn" onclick="selectRating(2)">2</button>
            <button type="button" class="rating-btn" onclick="selectRating(3)">3</button>
            <button type="button" class="rating-btn" onclick="selectRating(4)">4</button>
            <button type="button" class="rating-btn" onclick="selectRating(5)">5</button>
          </div>
          <div class="rating-labels">
            <span class="label-bad" id="lbl-bad">Sangat tidak puas</span>
            <span class="label-good" id="lbl-good">Sangat puas</span>
          </div>
        </div>

        <!-- Slide 3: Checkbox -->
        <div class="slide" id="slide-3">
          <div class="question-text" id="q-checkbox">
            Hal apa saja dari pelayanan <span>Staff dan Petugas</span> kami yang menurut Bapak / Ibu <span>Memuaskan?</span> <span style="color:#ef4444">*</span>
          </div>
          <div class="hint-text" id="hint-checkbox">Pilih semua yang menurut Anda benar</div>

          <div class="options-list" id="optionsList"></div>
          <div id="otherWrapper" style="display:none; margin-top:10px;">
            <input type="text" id="inputOther" class="input-no-style"
              placeholder="Tuliskan lainnya...">
          </div>
          <br>

          <button type="button" class="btn-primary" onclick="submitForm()" id="btn-submit">Selanjutnya</button>
        </div>

        <!-- HIDDEN INPUT -->
        <input type="hidden" name="survey_kepuasan" id="inputRating">
        <input type="hidden" name="survey_memuaskan" id="inputOptions">

        <!-- Slide 4: Success -->
        <div class="slide" id="slide-4">
          <div class="success-wrap">
            <div class="success-icon">✓</div>
            <div class="success-title" id="success-title">Terima Kasih!</div>
            <div class="success-desc" id="success-desc">Penilaian Anda telah berhasil dikirim. Kami sangat menghargai masukan Anda untuk meningkatkan kualitas layanan kami.</div>
          </div>
        </div>

      </div><!-- /slides -->
    </form>
  </div>

  <!-- Fixed Nav -->
  <div class="nav-bar">
    <button class="nav-btn" id="navUp" onclick="navUp()" title="Up">&#8679;</button>
    <button class="nav-btn" id="navDown" onclick="navDown()" title="Down">&#8681;</button>
  </div>

  <script>
    let currentSlide = 1;
    let totalSlides = 4;
    let selectedRating = null;
    let selectedOptions = new Set();
    let currentLang = 'id';

    const translations = {
      id: {
        langLabel: 'Bahasa',
        locTitle: 'SURVEI KEPUASAN',
        lblSubholding: 'SUBHOLDING',
        lblLocation: 'NAMA LOKASI',
        lblFloor: 'LANTAI',
        lblFacilityType: 'TIPE FASILITAS',
        lblFacilityId: 'ID FASILITAS',
        btnNext1: 'Selanjutnya',
        hint1: 'Tekan Enter',
        qRating: 'Seberapa puas Bapak / Ibu terhadap fasilitas <span>Toilet</span> kami? <span style="color:#ef4444">*</span>',
        lblBad: 'Sangat tidak puas',
        lblGood: 'Sangat puas',
        qCheckbox: 'Hal apa saja dari pelayanan <span>Staff dan Petugas</span> kami yang menurut Bapak / Ibu <span>Memuaskan?</span> <span style="color:#ef4444">*</span>',
        hintCheckbox: 'Pilih semua yang menurut Anda benar',
        btnSubmit: 'Selanjutnya',
        successTitle: 'Terima Kasih!',
        successDesc: 'Penilaian Anda telah berhasil dikirim. Kami sangat menghargai masukan Anda untuk meningkatkan kualitas layanan kami.',
        options: [
          'Petugas ramah dan sopan',
          'Berpenampilan rapi dengan seragam jelas',
          'Cepat tanggap saat membantu pasien',
          'Jumlah petugas cukup',
          'Lainnya'
        ]
      },
      en: {
        langLabel: 'English',
        locTitle: 'SERVICE SATISFACTION SURVEY',
        lblSubholding: 'SUBHOLDING',
        lblLocation: 'LOCATION NAME',
        lblFloor: 'FLOOR',
        lblFacilityType: 'FACILITY TYPE',
        lblFacilityId: 'FACILITY ID',
        btnNext1: 'Next',
        hint1: 'Press Enter',
        qRating: 'How satisfied are you with our <span>Toilet</span> facility? <span style="color:#ef4444">*</span>',
        lblBad: 'Very dissatisfied',
        lblGood: 'Very satisfied',
        qCheckbox: 'What aspects of our <span>Staff and Officer</span> service do you find <span>Satisfying?</span> <span style="color:#ef4444">*</span>',
        hintCheckbox: 'Select all that apply',
        btnSubmit: 'Submit',
        successTitle: 'Thank You!',
        successDesc: 'Your feedback has been successfully submitted. We greatly appreciate your input to improve our service quality.',
        options: [
          'Friendly and polite officers',
          'Neat appearance with clear uniform',
          'Quick to respond when assisting patients',
          'Sufficient number of officers',
          'Other'
        ]
      }
    };

    function setLang(lang) {
      currentLang = lang;
      const t = translations[lang];

      document.getElementById('langLabel').textContent = t.langLabel;
      document.getElementById('loc-title').textContent = t.locTitle;
      document.getElementById('lbl-location').textContent = t.lblLocation;
      document.getElementById('lbl-floor').textContent = t.lblFloor;
      document.getElementById('lbl-facility-type').textContent = t.lblFacilityType;
      // document.getElementById('lbl-facility-id').textContent = t.lblFacilityId;
      document.getElementById('btn-next-1').textContent = t.btnNext1;
      document.getElementById('hint-1').textContent = t.hint1;
      document.getElementById('q-rating').innerHTML = t.qRating;
      document.getElementById('lbl-bad').textContent = t.lblBad;
      document.getElementById('lbl-good').textContent = t.lblGood;
      document.getElementById('q-checkbox').innerHTML = t.qCheckbox;
      document.getElementById('hint-checkbox').textContent = t.hintCheckbox;
      document.getElementById('btn-submit').textContent = t.btnSubmit;
      document.getElementById('success-title').textContent = t.successTitle;
      document.getElementById('success-desc').textContent = t.successDesc;

      // Update language dropdown active state
      document.getElementById('opt-id').className = 'lang-option' + (lang === 'id' ? ' active' : '');
      document.getElementById('opt-en').className = 'lang-option' + (lang === 'en' ? ' active' : '');

      // Re-render options
      renderOptions();
      closeLang();
    }

    function renderOptions() {
      const list = document.getElementById('optionsList');
      const opts = translations[currentLang].options;
      list.innerHTML = '';
      opts.forEach((opt, i) => {
        const div = document.createElement('div');
        div.className = 'option-item' + (selectedOptions.has(i) ? ' selected' : '');
        div.innerHTML = `<span>${opt}</span><span class="check-icon">${selectedOptions.has(i) ? '✓' : ''}</span>`;
        div.onclick = () => toggleOption(i);
        list.appendChild(div);
      });
    }

    function toggleOption(i) {
      const opts = translations[currentLang].options;

      if (selectedOptions.has(i)) {
        selectedOptions.delete(i);
      } else {
        selectedOptions.add(i);
      }

      // 🔥 cek apakah "Lainnya" dipilih
      const isOtherSelected = opts[i].toLowerCase().includes('lain');

      if (isOtherSelected) {
        const wrapper = document.getElementById('otherWrapper');

        if (selectedOptions.has(i)) {
          wrapper.style.display = 'block';
          document.getElementById('inputOther').focus();
          document.getElementById('inputOther').setAttribute('required', true);
        } else {
          wrapper.style.display = 'none';
          document.getElementById('inputOther').removeAttribute('required');
          document.getElementById('inputOther').value = '';
        }
      }

      renderOptions();
      updateNavBtns();
    }

    function selectRating(val) {
      selectedRating = val;

      // simpan ke input hidden
      document.getElementById('inputRating').value = val;

      document.querySelectorAll('.rating-btn').forEach((btn, i) => {
        btn.classList.toggle('selected', i + 1 === val);
      });

      updateNavBtns();

      setTimeout(() => goSlide(3), 500);
    }

    function goSlide(n) {
      document.getElementById('slide-' + currentSlide).classList.remove('active');
      currentSlide = n;
      document.getElementById('slide-' + currentSlide).classList.add('active');
      updateProgress();
      updateNavBtns();
      if (n === 3) renderOptions();
    }

    function updateProgress() {
      const pct = (currentSlide / totalSlides) * 100;
      document.getElementById('progressFill').style.width = pct + '%';
    }

    function updateNavBtns() {
      const navUp = document.getElementById('navUp');
      const navDown = document.getElementById('navDown');

      // default disable semua
      navUp.disabled = true;
      navDown.disabled = true;

      // SLIDE 2 (Rating)
      if (currentSlide === 2) {
        if (selectedRating !== null) {
          navUp.disabled = false;
          navDown.disabled = false;
        }
      }

      // SLIDE 3 (Checkbox)
      if (currentSlide === 3) {
        if (selectedOptions.size > 0) {
          navUp.disabled = false;
          navDown.disabled = false;
        }
      }
    }

    function navUp() {
      if (currentSlide > 1) goSlide(currentSlide - 1);
    }

    function navDown() {
      if (currentSlide < totalSlides) goSlide(currentSlide + 1);
    }

    function submitForm() {

      const opts = translations[currentLang].options;
      let selectedText = [];

      selectedOptions.forEach(i => {
        let text = opts[i];

        // 🔥 skip "Lainnya"
        if (text.toLowerCase().includes('lain')) return;

        selectedText.push(text);
      });

      // 🔥 jika "Lainnya" dipilih → ambil input
      const otherInput = document.getElementById('inputOther');
      const isOtherSelected = Array.from(selectedOptions).some(i =>
        opts[i].toLowerCase().includes('lain')
      );

      if (isOtherSelected) {
        if (!otherInput.value.trim()) {
          alert('Isi bagian "Lainnya" terlebih dahulu!');
          return;
        }

        selectedText.push('Lainnya: ' + otherInput.value.trim());
      }

      // set ke hidden input
      document.getElementById('inputOptions').value = selectedText.join(', ');

      // ===== LANJUT AJAX (tetap sama)
      let form = document.getElementById('formSurvey');
      let formData = new FormData(form);

      let btn = document.getElementById('btn-submit');
      btn.disabled = true;
      btn.innerText = 'Menyimpan...';

      fetch("<?= base_url('survey/save'); ?>", {
          method: "POST",
          body: formData
        })
        .then(response => response.json())
        .then(res => {
          if (res.status === 'success') {
            goSlide(4);
          } else {
            alert('Gagal menyimpan!');
          }
        })
        .catch(err => {
          console.error(err);
          alert('Terjadi error!');
          btn.disabled = false;
          btn.innerText = 'Selanjutnya';
        });
    }

    function toggleLang() {
      document.getElementById('langDropdown').classList.toggle('open');
    }

    function closeLang() {
      document.getElementById('langDropdown').classList.remove('open');
    }

    document.addEventListener('click', function(e) {
      if (!e.target.closest('.lang-bar')) closeLang();
    });

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' && currentSlide === 1) goSlide(2);
    });

    // Init
    updateNavBtns();
    renderOptions();
  </script>
</body>

</html>