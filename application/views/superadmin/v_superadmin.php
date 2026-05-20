<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Survey Kepuasan Pasien - Primaya Hospital Karawang</title>
    <meta name="description" content="Elisyam is a Web App and Admin Dashboard Template built with Bootstrap 4">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Google Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Montserrat:400,500,600,700", "Noto+Sans:400,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!-- Favicon -->
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/img/favicon-16x16.png"> -->
    <link rel="icon" type="image/png" href="<?php echo base_url('assets-tamplate/img/logo-primaya.png'); ?>">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/css/base/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/css/base/elisyam-1.5.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/css/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/css/bootstrap-select/bootstrap-select.min.css">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body id="page-top">
    <!-- Begin Preloader -->
    <div id="preloader">
        <div class="canvas">
            <img src="<?php echo base_url('assets-tamplate/img/logo-primaya.png'); ?>" alt="logo" class="loader-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- End Preloader -->
    <div class="page">
        <!-- Begin Header -->
        <header class="header">
            <nav class="navbar fixed-top">
                <!-- Begin Search Box-->
                <div class="search-box">
                    <button class="dismiss"><i class="ion-close-round"></i></button>
                    <form id="searchForm" action="#" role="search">
                        <input type="search" placeholder="Search something ..." class="form-control">
                    </form>
                </div>
                <!-- End Search Box-->
                <!-- Begin Topbar -->
                <div class="navbar-holder d-flex align-items-center align-middle justify-content-between">
                    <!-- Begin Logo -->
                    <div class="navbar-header">
                        <a href="db-default.html" class="navbar-brand">
                            <div class="brand-image brand-big">
                                <img src="<?php echo base_url('assets-tamplate/img/logo-primaya.png'); ?>" alt="logo" class="logo-big">
                            </div>
                            <div class="brand-image brand-small">
                                <img src="<?php echo base_url('assets-tamplate/img/logo-primaya.png'); ?>" alt="logo" class="logo-small">
                            </div>
                        </a>
                        <!-- Toggle Button -->
                        <a id="toggle-btn" href="#" class="menu-btn active">
                            <span></span>
                            <span></span>
                            <span></span>
                        </a>
                        <!-- End Toggle -->
                    </div>
                    <!-- End Logo -->
                    <!-- Begin Navbar Menu -->
                    <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center pull-right">
                        <!-- Search -->
                        <!-- <li class="nav-item d-flex align-items-center"><a id="search" href="#"><i class="la la-search"></i></a></li> -->
                        <!-- End Search -->
                        <!-- Begin Notifications -->
                        <!-- <li class="nav-item dropdown"><a id="notifications" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="la la-bell animated infinite swing"></i><span class="badge-pulse"></span></a>
                            <ul aria-labelledby="notifications" class="dropdown-menu notification">
                                <li>
                                    <div class="notifications-header">
                                        <div class="title">Notifications (4)</div>
                                        <div class="notifications-overlay"></div>
                                        <img src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/img/notifications/01.jpg" alt="..." class="img-fluid">
                                    </div>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="message-icon">
                                            <i class="la la-user"></i>
                                        </div>
                                        <div class="message-body">
                                            <div class="message-body-heading">
                                                New user registered
                                            </div>
                                            <span class="date">2 hours ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="message-icon">
                                            <i class="la la-calendar-check-o"></i>
                                        </div>
                                        <div class="message-body">
                                            <div class="message-body-heading">
                                                New event added
                                            </div>
                                            <span class="date">7 hours ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="message-icon">
                                            <i class="la la-history"></i>
                                        </div>
                                        <div class="message-body">
                                            <div class="message-body-heading">
                                                Server rebooted
                                            </div>
                                            <span class="date">7 hours ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div class="message-icon">
                                            <i class="la la-twitter"></i>
                                        </div>
                                        <div class="message-body">
                                            <div class="message-body-heading">
                                                You have 3 new followers
                                            </div>
                                            <span class="date">10 hours ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a rel="nofollow" href="#" class="dropdown-item all-notifications text-center">View All Notifications</a>
                                </li>
                            </ul>
                        </li> -->
                        <!-- End Notifications -->
                        <!-- User -->
                        <li class="nav-item dropdown"><a id="user" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><img src="<?php echo base_url('assets-tamplate/img/user.png'); ?>" alt="..." class="avatar rounded-circle"></a>
                            <ul aria-labelledby="user" class="user-size dropdown-menu">
                                <li class="welcome">
                                    <a href="#" class="edit-profil"><i class="la la-gear"></i></a>
                                    <img src="<?php echo base_url('assets-tamplate/img/user.png'); ?>" alt="..." class="rounded-circle">
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item">
                                        Profile
                                    </a>
                                </li>
                                <!-- <li>
                                    <a href="app-mail.html" class="dropdown-item">
                                        Messages
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item no-padding-bottom">
                                        Settings
                                    </a>
                                </li> -->
                                <li class="separator"></li>
                                <li>
                                    <a href="<?php echo base_url('auth/logout'); ?>" class="dropdown-item no-padding-top">
                                        Logout
                                    </a>
                                </li>
                                <br>
                                <!-- <li><a rel="nofollow" href="pages-login.html" class="dropdown-item logout text-center"><i class="ti-power-off"></i></a></li> -->
                            </ul>
                        </li>
                        <!-- End User -->
                        <!-- Begin Quick Actions -->
                        <!-- <li class="nav-item"><a href="#off-canvas" class="open-sidebar"><i class="la la-ellipsis-h"></i></a></li> -->
                        <!-- End Quick Actions -->
                    </ul>
                    <!-- End Navbar Menu -->
                </div>
                <!-- End Topbar -->
            </nav>
        </header>
        <!-- End Header -->
        <!-- Begin Page Content -->
        <div class="page-content d-flex align-items-stretch">
            <div class="default-sidebar">
                <!-- Begin Side Navbar -->
                <nav class="side-navbar box-scroll sidebar-scroll">
                    <!-- Begin Main Navigation -->
                    <ul class="list-unstyled">
                        <li class="active"><a href="<?php echo base_url('superadmin'); ?>"><i class="la la-columns"></i><span>Hasil Survey</span></a></li>
                    </ul>
                    <!-- End Main Navigation -->
                </nav>
                <!-- End Side Navbar -->
            </div>
            <!-- End Left Sidebar -->
            <div class="content-inner">
                <div class="container-fluid">
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
                                        <!-- <a href="<?= base_url('superadmin/export_pdf') ?>"
                                            class="btn btn-primary">
                                            <span>PDF</span>
                                        </a> -->
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
                                                    <!-- <th>Actions</th> -->
                                                    <!-- <th></th> -->
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
                                                        <!-- <td class="td-actions">
                                                            <a href="<?= base_url('transaksi/edit/' . $su->id_survey) ?>">
                                                                <i class="la la-edit edit"></i>
                                                            </a>
                                                            <a href="<?= base_url('transaksi/delete/' . $su->id_survey) ?>" onclick="return confirm('Yakin hapus?')">
                                                                <i class="la la-close delete"></i>
                                                            </a>
                                                        </td> -->
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
                </div>
                <!-- End Container -->
                <!-- Begin Page Footer-->
                <footer class="main-footer">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex align-items-center justify-content-xl-start justify-content-lg-start justify-content-md-start justify-content-center">
                            <p class="text-gradient-02">&copy; <?= date('Y'); ?>. <a href="#">SURVEYPHKA.V.0.0.1</a> created by IT PHKA</a></p>
                        </div>
                    </div>
                </footer>
                <!-- End Page Footer -->
                <a href="#" class="go-top"><i class="la la-arrow-up"></i></a>
            </div>
        </div>
        <!-- End Page Content -->
    </div>
    <!-- Begin Vendor Js -->
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/js/base/jquery.min.js"></script>
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/js/base/core.min.js"></script>
    <!-- End Vendor Js -->

    <!-- Begin Page Vendor Js -->
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/js/datatables/datatables.min.js"></script>
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/js/datatables/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/js/datatables/jszip.min.js"></script>
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/js/datatables/buttons.html5.min.js"></script>
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/js/datatables/pdfmake.min.js"></script>
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/js/datatables/vfs_fonts.js"></script>
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/js/datatables/buttons.print.min.js"></script>
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/js/nicescroll/nicescroll.min.js"></script>
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/js/app/app.min.js"></script>
    <!-- End Page Vendor Js -->

    <!-- Begin Page Snippets -->
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/js/components/tables/tables.js"></script>
    <!-- End Page Snippets -->

    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/js/chart/chart.min.js"></script>
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/js/components/chartjs/chartjs.min.js"></script>
    <script src="<?php echo base_url('assets-tamplate/tamplate/') ?>assets/vendors/js/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- DataTables Init — harus SETELAH semua script di atas -->
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
                    "#ef4444", // 1
                    "#f97316", // 2
                    "#f59e0b", // 3
                    "#22c55e", // 4
                    "#16a34a" // 5
                ];

                // =========================
                // BAR CHART (VERTICAL)
                // =========================
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

                // =========================
                // PIE CHART
                // =========================
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
</body>
</body>

</html>