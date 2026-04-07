<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access portal</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>"/>
</head>
<body>

    <h1>Access portal</h1>
    
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
    <p>Welcome to the access portal. Here you can <strong>access</strong> your personal dashboard.<br></p>

    <p>To get started, either <a href="<?= site_url("login") ?>">login</a> to your account
     or <a href="<?= site_url("signup") ?>">create</a> one.</p>

</body>
</html>