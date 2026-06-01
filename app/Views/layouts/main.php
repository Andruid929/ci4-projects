<?php

use App\Helpers\PageNameHelper;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= PageNameHelper::getPageName() ?></title>
    <link href="<?= site_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= site_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?= site_url('vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
    <style>
        /* DataTables sort icon overrides */
        table.dataTable > thead .sorting:before,
        table.dataTable > thead .sorting_asc:before,
        table.dataTable > thead .sorting_desc:before,
        table.dataTable > thead .sorting_asc_disabled:before,
        table.dataTable > thead .sorting_desc_disabled:before {
            font-family: "Font Awesome 6 Free", "Font Awesome 5 Free", serif;
            font-weight: 900;
            content: "\f062";
            right: 1em;
            opacity: 0.3;
        }

        table.dataTable > thead .sorting:after,
        table.dataTable > thead .sorting_asc:after,
        table.dataTable > thead .sorting_desc:after,
        table.dataTable > thead .sorting_asc_disabled:after,
        table.dataTable > thead .sorting_desc_disabled:after {
            font-family: "Font Awesome 6 Free", "Font Awesome 5 Free", serif;
            font-weight: 900;
            content: "\f063";
            right: 0.5em;
            opacity: 0.3;
        }

        table.dataTable > thead .sorting_asc:before,
        table.dataTable > thead .sorting_desc:after {
            opacity: 1;
        }

        table.dataTable > thead .sorting_asc_disabled:before,
        table.dataTable > thead .sorting_desc_disabled:after {
            opacity: 0;
        }

        /* Response Modal Styling */
        #responseModal .modal-header.bg-success {
            background-color: #1cc88a !important;
        }

        #responseModal .modal-header.bg-danger {
            background-color: #e74c3c !important;
        }

        #responseModal .modal-header .text-white {
            color: white !important;
        }

        #responseModal .modal-header .close {
            color: white !important;
        }

        #responseModal .modal-body {
            word-wrap: break-word;
            white-space: pre-wrap;
        }
    </style>
</head>
<body id="page-top">
    
    <?php
    if (auth()->loggedIn()): ?>
    
    <div id="wrapper">
        <?= $this->include('\App\Views\components\sidebar') ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            
            <div id="content">
                <?= $this->include('\App\Views\components\navbar') ?>
                <?= $this->renderSection("content") ?>
            </div>
            
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Employee Manager <?= date("Y")?></span>
                    </div>
                </div>
                
            </footer>
            <!-- End of Footer -->
            
        </div>
    </div>
    
    <?php
    else: ?>
        <?= $this->renderSection("content") ?>
    
    <?php
    endif; ?>
    
    <!-- Response Modal (for AJAX messages) -->
    <?= view('components/modals/response') ?>
    
    <script src="<?= site_url('vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= site_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= site_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= site_url('vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= site_url('vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?= site_url('js/sb-admin-2.min.js') ?>"></script>
    <script src="<?= site_url('js/datatable-init.js') ?>"></script>
    
</body>
</html>
