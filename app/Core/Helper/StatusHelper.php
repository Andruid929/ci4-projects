<?php

namespace App\Core\Helper;

class StatusHelper
{

    public const APPROVED = "approved";

    public const PENDING = "pending";

    public const DENIED = "denied";

    public const ALL_STATUSES = [
        self::APPROVED,
        self::PENDING,
        self::DENIED
    ];
}
