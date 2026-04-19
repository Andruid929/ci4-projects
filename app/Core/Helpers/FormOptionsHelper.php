<?php

namespace App\Core\Helpers;

use App\Core\Common\Status;
use App\Core\Common\Priority;

class FormOptionsHelper {

    public static function isInvalidOption(array $validValues, string $value): bool {

        foreach($validValues as $v) {
            if ($value === $v) {
                return false;
            }
        }

        return true;
    }    

    public static function isInvalidStatus(string $value): bool {
        return self::isInvalidOption(Status::STATUSES, $value);
    }
    
    public static function isInvalidPriority(string $value): bool {
        return self::isInvalidOption(Priority::PRIORITIES, $value);
    }

}