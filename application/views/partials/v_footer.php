                <footer class="main-footer">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 d-flex align-items-center justify-content-xl-start justify-content-lg-start justify-content-md-start justify-content-center">
                            <p class="text-gradient-02">&copy; <?= date('Y'); ?>. <a href="#">Survey Kepuasan </a> - Primaya Hospital Karawang</p>
                        </div>
                    </div>
                </footer>
                <a href="#" class="go-top"><i class="la la-arrow-up"></i></a>
                </div>
                </div>
                </div>
                <script src="<?= base_url('assets-tamplate/tamplate/assets/vendors/js/datatables/datatables.min.js'); ?>"></script>
                <script src="<?= base_url('assets-tamplate/tamplate/assets/vendors/js/datatables/dataTables.buttons.min.js'); ?>"></script>
                <script src="<?= base_url('assets-tamplate/tamplate/assets/vendors/js/datatables/jszip.min.js'); ?>"></script>
                <script src="<?= base_url('assets-tamplate/tamplate/assets/vendors/js/datatables/buttons.html5.min.js'); ?>"></script>
                <script src="<?= base_url('assets-tamplate/tamplate/assets/vendors/js/datatables/pdfmake.min.js'); ?>"></script>
                <script src="<?= base_url('assets-tamplate/tamplate/assets/vendors/js/datatables/vfs_fonts.js'); ?>"></script>
                <script src="<?= base_url('assets-tamplate/tamplate/assets/vendors/js/datatables/buttons.print.min.js'); ?>"></script>
                <script src="<?= base_url('assets-tamplate/tamplate/assets/vendors/js/nicescroll/nicescroll.min.js'); ?>"></script>
                <script src="<?= base_url('assets-tamplate/tamplate/assets/vendors/js/app/app.min.js'); ?>"></script>
                <script src="<?= base_url('assets-tamplate/tamplate/assets/vendors/js/chart/chart.min.js'); ?>"></script>
                <!-- Bootstrap dimuat di sini agar terikat pada jQuery instance terakhir (setelah datatables overwrite jQuery) -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    if (typeof jQuery === 'undefined' || typeof jQuery.fn.modal === 'undefined') {
                        document.write('<script src="<?= base_url('assets-tamplate/tamplate/assets/vendors/js/base/bootstrap.bundle.min.js'); ?>"><\/script>');
                    }
                </script>
                <script src="<?= base_url('assets-tamplate/tamplate/assets/vendors/js/bootstrap-select/bootstrap-select.min.js'); ?>"></script>
                <script>
                    var CSRF_TOKEN = '<?= $this->security->get_csrf_hash(); ?>';
                </script>
                </body>

                </html>