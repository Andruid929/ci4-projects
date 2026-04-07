<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= session()->get("fullName") . "'s dashboard" ?></title>
    <link rel="stylesheet" href="<?= base_url('/css/style.css') ?>">
</head>
<body>
    
    <h1>This is a dashboard</h1>

    <?php
    $errors = session()->getFlashdata('errors');

    $success = session()->getFlashdata('success');

    if (!empty($errors)) {

        echo '<div class="error-div">';

        foreach ($errors as $error) {
            echo '<p class="per-error-message">' . $error . '</p>';
        }

        echo '</div>';
    }

    if (!empty($success)) {

        echo '<div class="success-div">';

        foreach ($success as $s) {
            echo '<p class="per-success-message">' . $s . '</p>';
        }

        echo '</div>';
    }
    ?>

    <p>Welcome, <?= session()->get("fullName") ?><br></p>
    <p>Email address: <?= session()->get("emailAddress") ?></p>
    <p>Last failed login attempt: <?= session()->get("lastActivity") ?> UTC</p>

    <button class="form-button"><a href="<?= base_url('logout') ?>">Logout</a></button>

</body>
</html>