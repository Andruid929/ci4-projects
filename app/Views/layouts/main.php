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
</head>
<body id="page-top">
    
    <?php if (auth()->loggedIn()): ?>
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
    <?php else: ?>
        <?= $this->renderSection("content") ?>
    <?php endif; ?>
    
    <script src="<?= site_url('vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= site_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= site_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= site_url('js/sb-admin-2.min.js') ?>"></script>
</body>
</html>
