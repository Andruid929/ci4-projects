<?php

namespace App\Modules\Employees\Helpers;

class StatusColourHelper
{

    public static function getStatusColour(string $status): string
    {
        return match ($status) {
            "active" => "bg-success",
            "inactive" => "bg-warning",
            "terminated" => "bg-danger",
            default => "bg-secondary"
        };
    }

} 