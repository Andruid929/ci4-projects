<?php

namespace App\Util;

class UserMessageDisplay
{

    private function __construct()
    {

    }

    public static function displayMessages()
    {
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
    }

}