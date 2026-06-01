<?php

namespace App\Helpers;

class EmployeeIdHelper
{

    public static function generateEmployeeId(): string
    {
        $random = random_bytes(6);
        $base32 = strtr(rtrim(base_convert(bin2hex($random), 16, 32), '='),
            '0123456789', 'abcdefgnrw');
        return strtoupper(substr($base32, 0, 10));
    }

}
