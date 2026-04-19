<?php

namespace App\Core\Helpers;

class JsScriptHelper
{

    public static function functionalModal(string $modalId, string $formId) //Make modal dialogs show, disappear
    {
        ?>
        <script>
            function openModal() {
                document.getElementById('<?= $modalId ?>').showModal();
            }

            function closeModal() {
                document.getElementById('<?= $modalId ?>').close();
                document.getElementById('<?= $formId ?>').reset();
            }

            document.getElementById('<?= $modalId ?>').addEventListener('click', function (event) {
                if (event.target === this) {
                    closeProjectModal();
                }
            });
        </script>
        <?php
    }

}