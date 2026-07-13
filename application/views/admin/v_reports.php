<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Laporan Survei</h2>
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>"><i class="ti ti-home"></i></a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Filter -->
<div class="row">
    <div class="col-xl-12">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions">
                <h4 class="mb-0">Filter</h4>
            </div>
            <div class="widget-body">
                <form id="filterForm" class="form-inline">
                    <div class="form-group mr-3">
                        <label class="mr-2">Ruangan</label>
                        <select class="form-control" id="filter-room">
                            <option value="">-- Semua Ruangan --</option>
                            <?php foreach ($rooms as $r): ?>
                            <option value="<?= $r->id ?>"><?= $r->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mr-3">
                        <label class="mr-2">Dari Tanggal</label>
                        <input type="date" class="form-control" id="filter-from">
                    </div>
                    <div class="form-group mr-3">
                        <label class="mr-2">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="filter-to">
                    </div>
                    <button type="button" class="btn btn-primary mr-2" id="btn-filter"><i class="fa fa-filter mr-1"></i> Filter</button>
                    <a href="#" class="btn btn-success" id="btn-export"><i class="fa fa-file-excel-o mr-1"></i> Export Excel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Summary Cards -->
<div class="row flex-row">
    <div class="col-xl-3 col-md-6">
        <div class="widget has-shadow">
            <div class="widget-body">
                <h6 class="text-muted mb-1">Total Respons</h6>
                <h3 class="mb-0" id="total-responses">0</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="widget has-shadow">
            <div class="widget-body">
                <h6 class="text-muted mb-1">Rata-rata Skor</h6>
                <h3 class="mb-0" id="avg-score">-</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="widget has-shadow">
            <div class="widget-body">
                <h6 class="text-muted mb-1">Skor Tertinggi</h6>
                <h3 class="mb-0" id="max-score">-</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="widget has-shadow">
            <div class="widget-body">
                <h6 class="text-muted mb-1">Skor Terendah</h6>
                <h3 class="mb-0" id="min-score">-</h3>
            </div>
        </div>
    </div>
</div>

<!-- Charts -->
<div class="row flex-row">
    <div class="col-xl-6">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions">
                <h4>Bar Chart Kepuasan</h4>
            </div>
            <div class="widget-body">
                <canvas id="barChart" style="height:300px"></canvas>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions">
                <h4>Pie Chart Kepuasan</h4>
            </div>
            <div class="widget-body">
                <canvas id="pieChart" style="height:300px"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="row">
    <div class="col-xl-12">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions">
                <h4>Detail Respons</h4>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table id="report-table" class="table mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ruangan</th>
                                <th>Responden</th>
                                <th>Skor</th>
                                <th>Komentar</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
var barChart, pieChart;
var colors = ['#ef4444', '#f97316', '#f59e0b', '#22c55e', '#16a34a'];
var labels = ['Sangat Tidak Puas', 'Tidak Puas', 'Cukup Puas', 'Puas', 'Sangat Puas'];

$(document).ready(function() {
    loadReport();

    $('#btn-filter').click(function() {
        loadReport();
    });

    $('#btn-export').click(function() {
        var room = $('#filter-room').val();
        var from = $('#filter-from').val();
        var to = $('#filter-to').val();
        var url = '<?= base_url('admin/export_excel'); ?>?room_id=' + room + '&date_from=' + from + '&date_to=' + to;
        window.location.href = url;
    });
});

function loadReport() {
    var room = $('#filter-room').val();
    var from = $('#filter-from').val();
    var to = $('#filter-to').val();
    var url = '<?= base_url('admin/get_report_data'); ?>?room_id=' + room + '&date_from=' + from + '&date_to=' + to;

    $.get(url, function(res) {
        var data = JSON.parse(res);

        // Update summary
        if (data.summary) {
            $('#total-responses').text(data.summary.total_responses || 0);
            $('#avg-score').text(data.summary.avg_score ? parseFloat(data.summary.avg_score).toFixed(1) : '-');
            $('#max-score').text(data.summary.max_score || '-');
            $('#min-score').text(data.summary.min_score || '-');
        }

        // Update charts
        var chartData = data.chart_data || [0, 0, 0, 0, 0];
        updateCharts(chartData);

        // Update table
        var tbody = $('#report-table tbody');
        tbody.empty();
        if (data.responses && data.responses.length > 0) {
            $.each(data.responses, function(i, r) {
                var ket = getScoreLabel(r.satisfaction_score);
                var warna = getScoreColor(r.satisfaction_score);
                tbody.append(
                    '<tr>' +
                    '<td class="text-center">' + (i + 1) + '</td>' +
                    '<td>' + r.room_name + '</td>' +
                    '<td>' + (r.respondent_name || 'Anonymous') + '</td>' +
                    '<td class="text-center"><span class="badge" style="background-color:' + warna + ';color:#fff;padding:6px 12px;border-radius:50%;">' + r.satisfaction_score + '</span> ' + ket + '</td>' +
                    '<td>' + (r.feedback || '-') + '</td>' +
                    '<td>' + r.created_at + '</td>' +
                    '</tr>'
                );
            });
        }
    });
}

function updateCharts(data) {
    if (barChart) barChart.destroy();
    if (pieChart) pieChart.destroy();

    barChart = new Chart(document.getElementById('barChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah',
                data: data,
                backgroundColor: colors,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
        }
    });

    pieChart = new Chart(document.getElementById('pieChart'), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{ data: data, backgroundColor: colors }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });
}

function getScoreLabel(s) {
    return ['Sangat Tidak Puas','Tidak Puas','Cukup Puas','Puas','Sangat Puas'][s - 1] || '-';
}
function getScoreColor(s) {
    return ['#ef4444','#f97316','#f59e0b','#22c55e','#16a34a'][s - 1] || '#6b7280';
}
</script>
