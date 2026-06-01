<?php

namespace App\Helpers;

class RolesHelper
{

    public const ADMIN = "admin";
    public const MANAGER = "manager";
    public const USER = "user";

    public const ALL_GROUPS = [
        self::ADMIN,
        self::MANAGER,
        self::USER
    ];
}
