<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($projectTitle) ?></title>
    <link rel="stylesheet" href="<?= base_url("/css/style.css") ?>">
</head>

<body>

    <div class="container">
        <?php

        use App\Core\Helpers\HtmlHelper;

        $headerTitle = "Project #" . esc($projectCode) . ": "
            . esc($projectTitle);

        $headerInfo = "Description: " . esc($projectDescription);

        HtmlHelper::renderHeader($headerTitle, $headerInfo);
        ?>

        <p>Status: <?= esc($projectStatus) ?></p>
        <p>Start date: <?= esc($projectStartDate) ?></p>

    </div>
</body>

</html>