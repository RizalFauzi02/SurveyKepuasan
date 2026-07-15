<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survei Kepuasan - <?= $room->name ?></title>
    <link rel="icon" type="image/png" href="<?= base_url('assets-tamplate/img/logo-primaya.png'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            min-height: 600px;
            position: relative;
        }

        .header {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 100%);
            padding: 32px 24px;
            text-align: center;
            color: white;
        }

        .header img {
            max-width: 60px;
            margin-bottom: 12px;
        }

        .header h1 {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .header p {
            font-size: 13px;
            opacity: 0.8;
        }

        .header .room-badge {
            display: inline-block;
            background: rgba(255, 255, 255, 0.15);
            padding: 6px 16px;
            border-radius: 20px;
            margin-top: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .nav-bar {
            display: flex;
            gap: 8px;
            padding: 16px 20px;
            overflow-x: auto;
            border-bottom: 1px solid var(--border);
        }

        .nav-bar a {
            flex-shrink: 0;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            border: 1.5px solid var(--border);
            color: var(--text);
            transition: all 0.2s;
        }

        .nav-bar a.active,
        .nav-bar a:hover {
            background: var(--selected-bg);
            color: var(--selected-text);
            border-color: var(--selected-bg);
        }

        .body {
            padding: 24px 20px;
        }

        .section-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .question {
            margin-bottom: 28px;
        }

        .question-label {
            font-size: 15px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .options {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border: 1.5px solid var(--border);
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.2s;
            background: #fafbff;
        }

        .option:hover {
            border-color: var(--blue-light);
            background: var(--option-bg);
        }

        .option input {
            display: none;
        }

        .option.selected {
            border-color: var(--selected-bg);
            background: var(--selected-bg);
            color: var(--selected-text);
        }

        .option.selected .option-indicator {
            border-color: var(--selected-text);
        }

        .option.selected .option-indicator::after {
            background: var(--selected-text);
        }

        .option-indicator {
            width: 20px;
            height: 20px;
            border: 2px solid var(--border);
            border-radius: 50%;
            flex-shrink: 0;
            position: relative;
            transition: all 0.2s;
        }

        .option-indicator.checkbox {
            border-radius: 6px;
        }

        .option-indicator::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 0;
            height: 0;
            border-radius: 50%;
            background: var(--selected-text);
            transition: all 0.2s;
        }

        .option.selected .option-indicator::after {
            width: 8px;
            height: 8px;
        }

        .option-text {
            font-size: 14px;
            font-weight: 500;
        }

        .text-input {
            width: 100%;
            padding: 14px 16px;
            border: 1.5px solid var(--border);
            border-radius: 14px;
            font-size: 14px;
            font-family: inherit;
            resize: vertical;
            min-height: 80px;
            outline: none;
            transition: border-color 0.2s;
        }

        .text-input:focus {
            border-color: var(--blue-light);
        }

        .rating-container {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .rating-item {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            border: 2px solid var(--border);
            background: #fafbff;
        }

        .rating-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .rating-item.selected {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .rating-item[data-value="1"] {
            border-color: var(--red-1);
        }

        .rating-item[data-value="1"].selected {
            background: var(--red-1);
            color: white;
        }

        .rating-item[data-value="2"] {
            border-color: var(--red-2);
        }

        .rating-item[data-value="2"].selected {
            background: var(--red-2);
            color: white;
        }

        .rating-item[data-value="3"] {
            border-color: var(--amber);
        }

        .rating-item[data-value="3"].selected {
            background: var(--amber);
            color: white;
        }

        .rating-item[data-value="4"] {
            border-color: var(--green-4);
        }

        .rating-item[data-value="4"].selected {
            background: var(--green-4);
            color: white;
        }

        .rating-item[data-value="5"] {
            border-color: var(--green-5);
        }

        .rating-item[data-value="5"].selected {
            background: var(--green-5);
            color: white;
        }

        .rating-number {
            font-size: 20px;
            font-weight: 700;
            line-height: 1;
        }

        .rating-label {
            font-size: 9px;
            margin-top: 2px;
            opacity: 0.8;
        }

        .emoji-row {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 8px;
        }

        .emoji {
            font-size: 14px;
        }

        .submit-area {
            padding: 0 20px 32px;
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 50px;
            background: linear-gradient(135deg, var(--navy) 0%, var(--blue) 100%);
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            font-family: inherit;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(29, 78, 216, 0.3);
        }

        .btn-submit:disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: none;
        }

        .thank-you {
            text-align: center;
            padding: 60px 24px;
            display: none;
        }

        .thank-you .icon {
            font-size: 64px;
            margin-bottom: 16px;
        }

        .thank-you h2 {
            font-size: 22px;
            color: var(--text);
            margin-bottom: 8px;
        }

        .thank-you p {
            color: var(--text-muted);
            font-size: 14px;
            line-height: 1.6;
        }

        .btn-new {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            border-radius: 50px;
            background: var(--selected-bg);
            color: white;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
        }

        .btn-new:hover {
            background: var(--navy);
        }
    </style>
</head>

<body>
    <div class="app">
        <div class="header">
            <img src="<?= base_url('assets-tamplate/img/logo-primaya.png'); ?>" alt="Logo">
            <h1>Primaya Hospital Karawang</h1>
            <p>Survey Kepuasan Pasien</p>
            <div class="room-badge"><?= $room->name ?> — Lantai <?= $room->floor ?></div>
        </div>

        <div class="nav-bar" style="display: none;">
            <?php foreach ($rooms as $r): ?>
                <a href="<?= base_url('survey/form/' . $r->slug); ?>" class="<?= $r->slug === $room->slug ? 'active' : '' ?>">
                    <?= $r->name ?>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="body" id="survey-form">
            <form id="formSurvei">
                <input type="hidden" name="room_id" value="<?= $room->id ?>">

                <!-- Rating Section -->
                <div class="question">
                    <div class="section-title">Bagaimana tingkat kepuasan Anda?</div>
                    <div class="rating-container" id="rating-container">
                        <div class="rating-item" data-value="1">
                            <span class="rating-number">1</span>
                        </div>
                        <div class="rating-item" data-value="2">
                            <span class="rating-number">2</span>
                        </div>
                        <div class="rating-item" data-value="3">
                            <span class="rating-number">3</span>
                        </div>
                        <div class="rating-item" data-value="4">
                            <span class="rating-number">4</span>
                        </div>
                        <div class="rating-item" data-value="5">
                            <span class="rating-number">5</span>
                        </div>
                    </div>
                    <div class="emoji-row">
                        <span class="emoji" data-for="1">😡</span>
                        <span class="emoji" data-for="2">😟</span>
                        <span class="emoji" data-for="3">😐</span>
                        <span class="emoji" data-for="4">😊</span>
                        <span class="emoji" data-for="5">😍</span>
                    </div>
                    <input type="hidden" name="satisfaction_score" id="satisfaction-score" required>
                </div>

                <!-- Dynamic Questions -->
                <div id="dynamic-questions-container">
                    <?php foreach ($questions as $q): ?>
                        <div class="question">
                            <div class="question-label"><?= $q->question_text ?></div>
                            <?php if ($q->question_type === 'radio'): ?>
                                <div class="options">
                                    <?php
                                    $options = json_decode($q->options, true);
                                    if ($options):
                                        foreach ($options as $opt): ?>
                                            <label class="option" data-name="question_<?= $q->id ?>" data-value="<?= $opt ?>">
                                                <input type="radio" name="question_<?= $q->id ?>" value="<?= $opt ?>">
                                                <span class="option-indicator"></span>
                                                <span class="option-text"><?= $opt ?></span>
                                            </label>
                                    <?php endforeach;
                                    endif; ?>
                                </div>
                            <?php elseif ($q->question_type === 'checkbox'): ?>
                                <div class="options">
                                    <?php
                                    $options = json_decode($q->options, true);
                                    if ($options):
                                        foreach ($options as $opt): ?>
                                            <label class="option" data-name="question_<?= $q->id ?>" data-value="<?= $opt ?>">
                                                <input type="checkbox" name="question_<?= $q->id ?>[]" value="<?= $opt ?>">
                                                <span class="option-indicator checkbox"></span>
                                                <span class="option-text"><?= $opt ?></span>
                                            </label>
                                    <?php endforeach;
                                    endif; ?>
                                </div>
                            <?php else: ?>
                                <textarea class="text-input" name="question_<?= $q->id ?>" placeholder="Tulis jawaban Anda di sini..."></textarea>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Name (Optional) -->
                <div class="question">
                    <div class="question-label">Nama Anda <span style="color:var(--text-muted);font-weight:400;">(opsional)</span></div>
                    <input type="text" class="text-input" name="respondent_name" placeholder="Masukkan nama Anda (opsional)" style="min-height:auto;resize:none;">
                </div>

                <!-- Feedback -->
                <div class="question">
                    <div class="question-label">Komentar atau Saran <span style="color:var(--text-muted);font-weight:400;">(opsional)</span></div>
                    <textarea class="text-input" name="feedback" placeholder="Tulis komentar atau saran Anda di sini..."></textarea>
                </div>
            </form>
        </div>

        <div class="submit-area" id="submit-area">
            <button class="btn-submit" id="btn-submit">Kirim Survei</button>
        </div>

        <div class="thank-you" id="thank-you">
            <div class="icon">🎉</div>
            <h2>Terima Kasih!</h2>
            <p>Partisipasi Anda sangat berharga bagi kami untuk meningkatkan kualitas pelayanan.</p>
            <a href="<?= base_url('survey/form/' . $room->slug); ?>" class="btn-new">Isi Survei Lagi</a>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Rating selection
            $('.rating-item').click(function() {
                var val = $(this).data('value');
                $('.rating-item').removeClass('selected');
                $(this).addClass('selected');
                $('#satisfaction-score').val(val);
            });

            // Option selection (radio) - Event Delegation for dynamic inputs
            $(document).on('change', 'input[type="radio"]', function() {
                var name = $(this).attr('name');
                $('[data-name="' + name + '"]').removeClass('selected');
                $(this).closest('.option').addClass('selected');
            });

            // Option selection (checkbox) - Event Delegation for dynamic inputs
            $(document).on('change', 'input[type="checkbox"]', function() {
                var label = $(this).closest('.option');
                if ($(this).is(':checked')) {
                    label.addClass('selected');
                } else {
                    label.removeClass('selected');
                }
            });

            // Text input focus - Event Delegation for dynamic inputs
            $(document).on('focus', '.text-input', function() {
                $(this).css('border-color', 'var(--blue-light)');
            }).on('blur', '.text-input', function() {
                $(this).css('border-color', 'var(--border)');
            });

            // Dynamic Questions HTML Renderer
            function renderQuestions(questions) {
                var container = $('#dynamic-questions-container');
                container.empty();

                if (!questions || questions.length === 0) {
                    return;
                }

                questions.forEach(function(q) {
                    var html = '<div class="question">';
                    html += '    <div class="question-label">' + escapeHtml(q.question_text) + '</div>';

                    if (q.question_type === 'radio') {
                        html += '    <div class="options">';
                        var options = [];
                        try {
                            options = JSON.parse(q.options);
                        } catch (e) {
                            options = [];
                        }
                        if (Array.isArray(options)) {
                            options.forEach(function(opt) {
                                html += '        <label class="option" data-name="question_' + q.id + '" data-value="' + escapeHtml(opt) + '">';
                                html += '            <input type="radio" name="question_' + q.id + '" value="' + escapeHtml(opt) + '">';
                                html += '            <span class="option-indicator"></span>';
                                html += '            <span class="option-text">' + escapeHtml(opt) + '</span>';
                                html += '        </label>';
                            });
                        }
                        html += '    </div>';
                    } else if (q.question_type === 'checkbox') {
                        html += '    <div class="options">';
                        var options = [];
                        try {
                            options = JSON.parse(q.options);
                        } catch (e) {
                            options = [];
                        }
                        if (Array.isArray(options)) {
                            options.forEach(function(opt) {
                                html += '        <label class="option" data-name="question_' + q.id + '" data-value="' + escapeHtml(opt) + '">';
                                html += '            <input type="checkbox" name="question_' + q.id + '[]" value="' + escapeHtml(opt) + '">';
                                html += '            <span class="option-indicator checkbox"></span>';
                                html += '            <span class="option-text">' + escapeHtml(opt) + '</span>';
                                html += '        </label>';
                            });
                        }
                        html += '    </div>';
                    } else {
                        html += '    <textarea class="text-input" name="question_' + q.id + '" placeholder="Tulis jawaban Anda di sini..."></textarea>';
                    }

                    html += '</div>';
                    container.append(html);
                });
            }

            // HTML escaping utility for security
            function escapeHtml(text) {
                if (!text) return '';
                var map = {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                };
                return text.replace(/[&<>"']/g, function(m) {
                    return map[m];
                });
            }

            // Navbar room switching via AJAX
            $('.nav-bar a').click(function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                var activeLink = $(this);

                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === 'success') {
                            var room = res.room;
                            var questions = res.questions;

                            // Update active state in navbar
                            $('.nav-bar a').removeClass('active');
                            activeLink.addClass('active');

                            // Update room info
                            $('.header .room-badge').text(room.name + ' — Lantai ' + room.floor);
                            $('title').text('Survei Kepuasan - ' + room.name);
                            $('input[name="room_id"]').val(room.id);
                            $('.btn-new').attr('href', url);

                            // Reset rating UI and value
                            $('.rating-item').removeClass('selected');
                            $('#satisfaction-score').val('');

                            // Reset optional form text fields
                            $('input[name="respondent_name"]').val('');
                            $('textarea[name="feedback"]').val('');

                            // Render new dynamic questions
                            renderQuestions(questions);

                            // Switch view back to form if in thank you screen
                            $('#thank-you').hide();
                            $('#survey-form').show();
                            $('#submit-area').show();

                            // Update browser URL without reloading
                            history.pushState(null, '', url);
                        } else {
                            Swal.fire('Gagal', res.message || 'Gagal memuat data ruangan.', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Terjadi kesalahan saat memuat data ruangan.', 'error');
                    }
                });
            });

            // Dynamic reset when clicking "Isi Survei Lagi" (no reload)
            $(document).on('click', '.btn-new', function(e) {
                e.preventDefault();

                var currentRoomId = $('input[name="room_id"]').val();

                // Reset rating UI
                $('.rating-item').removeClass('selected');
                $('#satisfaction-score').val('');

                // Reset standard form inputs
                $('#formSurvei')[0].reset();

                // Restore correct room id
                $('input[name="room_id"]').val(currentRoomId);

                // Remove selected state class from custom labels
                $('.option').removeClass('selected');

                // Switch view
                $('#thank-you').hide();
                $('#survey-form').show();
                $('#submit-area').show();
            });

            // Submit Form via AJAX
            $('#btn-submit').click(function() {
                var score = $('#satisfaction-score').val();
                if (!score) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Perhatian',
                        text: 'Silahkan pilih tingkat kepuasan Anda terlebih dahulu.'
                    });
                    return;
                }

                var btn = $(this);
                btn.prop('disabled', true).text('Mengirim...');

                $.ajax({
                    url: '<?= base_url('survey/submit'); ?>',
                    type: 'POST',
                    data: $('#formSurvei').serialize(),
                    dataType: 'json',
                    success: function(res) {
                        if (res.status === 'success') {
                            $('#survey-form').hide();
                            $('#submit-area').hide();
                            $('#thank-you').show();
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                        btn.prop('disabled', false).text('Kirim Survei');
                    },
                    error: function() {
                        Swal.fire('Error', 'Terjadi kesalahan server. Silahkan coba lagi.', 'error');
                        btn.prop('disabled', false).text('Kirim Survei');
                    }
                });
            });
        });
    </script>
</body>

</html>