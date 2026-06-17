<?php

namespace App\Modules\InternalRequests\Helpers;

class InternalRequestTypeHelper
{

    public const CAREER = "career_advancement";

    public const COMPENSATION = "compensation";

    public const OPERATIONAL = "operatinal";

    public const ADMINISTRATIVE = "administrative";

    public const ALL_REQUEST_TYPES = [
        self::ADMINISTRATIVE,
        self::CAREER,
        self::COMPENSATION,
        self::OPERATIONAL
    ];

}
