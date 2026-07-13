<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Dashboard Admin</h2>
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>"><i class="ti ti-home"></i></a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row flex-row">
    <div class="col-xl-4 col-md-6">
        <div class="widget has-shadow">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Ruangan</h6>
                        <h3 class="mb-0" id="total-rooms">-</h3>
                    </div>
                    <div class="icon-box bg-primary text-white rounded-circle" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;">
                        <i class="fa fa-door-open"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="widget has-shadow">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Survei</h6>
                        <h3 class="mb-0" id="total-surveys">-</h3>
                    </div>
                    <div class="icon-box bg-success text-white rounded-circle" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;">
                        <i class="fa fa-clipboard"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6">
        <div class="widget has-shadow">
            <div class="widget-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Rata-rata Skor</h6>
                        <h3 class="mb-0" id="avg-score">-</h3>
                    </div>
                    <div class="icon-box bg-warning text-white rounded-circle" style="width:50px;height:50px;display:flex;align-items:center;justify-content:center;">
                        <i class="fa fa-star"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions">
                <h4>Aksi Cepat</h4>
            </div>
            <div class="widget-body">
                <a href="<?= base_url('admin/rooms'); ?>" class="btn btn-primary mr-2"><i class="fa fa-door-open mr-1"></i> Kelola Ruangan</a>
                <a href="<?= base_url('admin/questions'); ?>" class="btn btn-info mr-2"><i class="fa fa-question-circle mr-1"></i> Kelola Pertanyaan</a>
                <a href="<?= base_url('admin/reports'); ?>" class="btn btn-success"><i class="fa fa-bar-chart mr-1"></i> Lihat Laporan</a>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Load dashboard stats
    $.get('<?= base_url('admin/get_report_data'); ?>', function(res) {
        var data = JSON.parse(res);
        if (data.summary) {
            $('#total-surveys').text(data.summary.total_responses || 0);
            $('#avg-score').text(data.summary.avg_score ? parseFloat(data.summary.avg_score).toFixed(1) : '-');
        }
    });
    $.get('<?= base_url('admin/get_rooms'); ?>?draw=1&start=0&length=1', function(res) {
        var data = JSON.parse(res);
        $('#total-rooms').text(data.recordsTotal || 0);
    });
});
</script>
