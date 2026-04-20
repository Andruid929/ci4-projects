<?php

namespace App\Core\Helpers;

class HtmlHelper
{
    public static function renderHeader(string $title, string $info = '') //Create a header and description
    {
        ?>
        <div class="header">
            <h1><?= $title ?></h1>
            <?php if ($info): ?>
                <p><?= $info ?></p>
            <?php endif; ?>
        </div>
        <?php
    }

    public static function renderAddNewBtn(string $text)
    {
        ?>
        <div class="flex-between mb-20">
            <div></div>
            <button class="btn btn-primary" onclick="openModal()">+ <?= $text ?></button>
        </div>
        <?php
    }

    public static function renderEmpty(string $itemName)
    {
        ?>
        <tr>
            <td colspan="3" class="text-center text-muted">
                No <?= $itemName ?>s found. Create a new <?= $itemName ?> to get started.
            </td>
        </tr>
        <?php
    }

    public static function renderAlertErrorDiv() //Create error info dialogs
    {
        $errors = session()->getFlashdata('errors');

        if (!empty($errors)): ?>

            <div class="error-div">

                <?php foreach ($errors as $error): ?>
                    <p class="per-error-message"> <?= $error ?> </p>
                <?php endforeach; ?>

            </div>
        <?php endif;
    }

    public static function renderAlertSuccessDiv() //Create success info dialogs
    {
        $success = session()->getFlashdata('success');

        if (!empty($success)): ?>

            <div class="success-div">

                <?php foreach ($success as $s): ?>
                    <p class="per-success-message"> <?= $s ?> </p>
                <?php endforeach; ?>

            </div>
        <?php endif;
    }
}