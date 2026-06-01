<?php

namespace App\Helpers;

class StatusBadgeHelper
{

    public static function getStatusColour(string $status): string
    {
        $badge = match ($status) {
            "approved" => "success",
            "denied" => "danger",
            default => "warning"
        };

        return "badge-$badge";
    }

}
