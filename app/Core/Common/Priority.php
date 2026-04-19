<?php

namespace App\Core\Common;

class Priority
{

    private function __construct() {
    }

    public const LOW = "low";
    public const MEDIUM = "medium";
    public const HIGH = "high";

    public const PRIORITIES = [
        self::LOW,
        self::MEDIUM,
        self::HIGH
    ];
}