<?php

namespace App\Modules\Employees\Helpers;

class DisplayHelper
{

    public static function displayGender(string $gender): string
    {
        return match ($gender) {
            "m" => "Male",
            "f" => "Female",
            default => "N/A"
        };
    }

}