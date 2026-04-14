<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal login</title>
    <link rel="stylesheet" href="<?= base_url("/css/style.css") ?>" />
</head>

<body>

    <h1>Login to the portal</h1>

    <?php
    use App\Util\UserMessageDisplay;

    UserMessageDisplay::displayMessages();
    ?>

    <div class="form-container">

        <form method="POST" action="<?= site_url("login/submit") ?>" class="form">
        
            <?= csrf_field() ?>

            <div class="form-group">

                <input type="text" placeholder="Email address" name="email" value="<?= set_value('email') ?>"
                    class="form-input" required />

            </div>

            <div class="form-group">
                <input type="password" placeholder="Password" name="password" class="form-input" required />
            </div>

            <button class="form-button" type="submit">Login</button>

            <p>Don't have an account? <a href="<?= site_url("signup") ?>">Sign up</a>.</p>
        </form>

    </div>
</body>

</html>