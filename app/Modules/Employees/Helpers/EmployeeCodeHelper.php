<?php

namespace App\Modules\Employees\Helpers;

class EmployeeCodeHelper
{

    public static function generateEmployeeCode(int $id): string
    {
        return 'EMP' . str_pad((string) $id, 3, '0', STR_PAD_LEFT);
    }

}