<!-- Begin Page Header-->
<div class="row">
    <div class="page-header">
        <div class="d-flex align-items-center">
            <h2 class="page-header-title">Hasil Survey Kepuasan Pasien</h2>
            <div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('superadmin'); ?>"><i class="ti ti-home"></i></a></li>
                    <li class="breadcrumb-item active">Hasil Survey</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Page Header -->
<!-- ==================== CHART HASIL SURVEY ================================= -->
<div class="row flex-row">
    <div class="col-xl-6">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex justify-content-between align-items-center">

                <!-- JUDUL -->
                <h4 class="mb-0">Bar Chart Kepuasan Pasien</h4>

            </div>

            <div class="widget-body">
                <div class="chart" style="height:300px;">
                    <canvas id="vertical-chart-02"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4>Pie Chart Kepuasan Pasien</h4>
            </div>
            <div class="widget-body">
                <div class="chart">
                    <canvas id="pie-chart" style="max-height:250px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ==================== DATA HASIL SURVEY ================================= -->
<div class="row">
    <div class="col-xl-12">
        <!-- Sorting -->
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">

                <h4 class="mb-0">Hasil Survey Kepuasan Pasien</h4>

                <div class="ml-auto d-flex" style="gap: 10px;">
                    <a href="<?= base_url('superadmin/export_excel') ?>"
                        class="btn btn-primary">
                        <span>Excel</span>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="table-responsive">
                    <table id="custom-datatables" class="table mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lokasi</th>
                                <th>Lantai</th>
                                <th>Tipe Fasilitas</th>
                                <th><span style="width:100px;">Survey Kepuasan</span></th>
                                <th>Survey Memuaskan</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($survey as $su): ?>
                                <tr class="text-primary">
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td><?= $su->nama_lokasi ?></td>
                                    <td class="text-center"><?= $su->lantai ?></td>
                                    <td><?= $su->tipe_fasilitas ?></td>
                                    <td class="text-center">
                                        <?php
                                        $nilai = $su->survey_kepuasan;

                                        if ($nilai == 1) {
                                            $warna = '#ef4444';
                                        } elseif ($nilai == 2) {
                                            $warna = '#f97316';
                                        } elseif ($nilai == 3) {
                                            $warna = '#f59e0b';
                                        } elseif ($nilai == 4) {
                                            $warna = '#22c55e';
                                        } elseif ($nilai == 5) {
                                            $warna = '#16a34a';
                                        } else {
                                            $warna = '#6b7280';
                                        }
                                        ?>

                                        <span style="width:100px;">
                                            <span class="badge-text badge-text-small"
                                                style="background-color: <?= $warna ?>; color:white; border-radius:50%; padding:8px 12px;">
                                                <?= $nilai ?>
                                            </span>
                                        </span>
                                    </td>
                                    <td><?= $su->survey_memuaskan ?></td>
                                    <td><?= $su->created_at ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- End Sorting -->
    </div>
</div>
<!-- End Row -->

<!-- DataTables Init -->
<script>
    $(document).ready(function() {
        $('#custom-datatables').DataTable({
            responsive: true,
            columnDefs: [{
                targets: [0, 2, 4],
                className: 'text-center'
            }],
            order: [
                [6, 'desc']
            ]
        });
    });
</script>

<script>
    fetch("<?= base_url('superadmin/get_chart_kepuasan') ?>")
        .then(response => response.json())
        .then(data => {

            const labels = [
                "Sangat Tidak Puas",
                "Tidak Puas",
                "Cukup Puas",
                "Puas",
                "Sangat Puas"
            ];

            const colors = [
                "#ef4444",
                "#f97316",
                "#f59e0b",
                "#22c55e",
                "#16a34a"
            ];

            // BAR CHART (VERTICAL)
            new Chart(document.getElementById("vertical-chart-02"), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Survey',
                        data: data,
                        backgroundColor: colors,
                        borderRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            }
                        }
                    }
                }
            });

            // PIE CHART
            new Chart(document.getElementById("pie-chart"), {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: colors
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

        });
</script>