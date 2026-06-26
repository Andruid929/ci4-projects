<?php

namespace App\Core\Helper;

class RequestTypeValidationHelper
{

    public static function isInvalid(array $validValues, string $value): bool
    {
        if ($value === null) {
            return true;
        }

        return !in_array($value, $validValues, true);
    }

}
