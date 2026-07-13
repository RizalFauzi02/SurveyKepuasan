<?php $this->load->view('partials/v_header'); ?>
<?php $this->load->view('partials/v_navbar'); ?>
        <div class="page-content d-flex align-items-stretch">
<?php $this->load->view('partials/v_sidebar'); ?>
            <div class="content-inner">
                <div class="container-fluid">
<?php $this->load->view($content); ?>
                </div>
<?php $this->load->view('partials/v_footer'); ?>
