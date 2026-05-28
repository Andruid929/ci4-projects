<?php

namespace App\Modules\Employees\Helpers;

class EmployeeCodeHelper
{

    public static function generateEmployeeCode(): string
    {
        $random = random_bytes(6);
        $base32 = strtr(rtrim(base_convert(bin2hex($random), 16, 32), '='), 
            '0123456789', 'abcdefghij');
        return 'EMP-' . strtoupper(substr($base32, 0, 8));
    }

}