<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="<?= base_url("/css/style.css") ?>"/>
</head>
<body>

    <h1>Create an account</h1>

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

    <div class="form-container">

        <form method="POST" action="<?= site_url("signup/submit") ?>" class="form">

            <div class="form-group">

                <input type="text" placeholder="First name" name="first-name" value="<?= set_value('first-name') ?>"
                    class="form-input" required />

            </div>
            
            <div class="form-group">

                <input type="text" placeholder="Last name" name="last-name" value="<?= set_value('last-name') ?>"
                    class="form-input" required />

            </div>

            <div class="form-group">

                <input type="text" placeholder="Email address" name="email" value="<?= set_value('email') ?>"
                    class="form-input" required />

            </div>

            <div class="form-group">
                <input type="password" placeholder="Password" name="password" class="form-input" required />
            </div>
            
            <div class="form-group">
                <input type="password" placeholder="Confirm password" name="confirm" class="form-input" required />
            </div>

            <button class="form-button" type="submit">Sign up</button>
        </form>

    </div>

</body>
</html>