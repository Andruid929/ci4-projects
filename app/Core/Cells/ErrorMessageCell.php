<?php

namespace App\Core\Cells;

class ErrorMessageCell {

    public function render($data)
    {
        return '<p class="per-error-message">' . $data[0] .'</p>';
    }

}