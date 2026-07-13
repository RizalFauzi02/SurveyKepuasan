<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= isset($title) ? $title . ' - ' : '' ?>Survey Kepuasan Pasien</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    <link rel="icon" type="image/png" href="<?= base_url('assets-tamplate/img/logo-primaya.png'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets-tamplate/tamplate/assets/vendors/css/base/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets-tamplate/tamplate/assets/vendors/css/base/elisyam-1.5.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets-tamplate/tamplate/assets/css/datatables/datatables.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets-tamplate/tamplate/assets/css/bootstrap-select/bootstrap-select.min.css'); ?>">
    <!-- Font Awesome 7 -->
    <link rel="stylesheet" href="<?= base_url('assets-tamplate/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets-tamplate/fontawesome/css/regular.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets-tamplate/fontawesome/css/solid.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets-tamplate/fontawesome/css/brands.min.css'); ?>">
    <!-- Font Awesome 7 -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script>
        if (typeof jQuery === 'undefined') {
            document.write('<script src="<?= base_url('assets-tamplate/tamplate/assets/vendors/js/base/jquery.min.js'); ?>"><\/script>');
        }
    </script>
    <!-- Bootstrap dimuat di footer agar terikat pada jQuery instance yang aktif setelah datatables -->
    <style>
        .modal-backdrop {
            z-index: 1040 !important;
        }

        .modal {
            z-index: 1050 !important;
        }

        .swal2-container {
            z-index: 9999 !important;
        }
    </style>
</head>

<body id="page-top">
    <div id="preloader">
        <div class="canvas">
            <img src="<?= base_url('assets-tamplate/img/logo-primaya.png'); ?>" alt="logo" class="loader-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <div class="page">