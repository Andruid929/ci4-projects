<?php

namespace App\Core\Common;

class Status
{

    private function __construct() {
    }

    public const NOT_STARTED = "open";
    public const IN_PROGRESS = "in_progress";
    public const COMPLETED = "closed";

    public const STATUSES = [
        self::NOT_STARTED,
        self::IN_PROGRESS,
        self::COMPLETED
    ];
}