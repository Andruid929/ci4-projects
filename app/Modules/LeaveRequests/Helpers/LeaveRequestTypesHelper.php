<?php

namespace App\Modules\LeaveRequests\Helpers;

class LeaveRequestTypesHelper
{

    public const SICK = "sick";

    public const VACATION = "vacation";

    public const PERSONAL = "personal";

    public const BEREAVEMENT = "bereavement";

    public const MATERNITY = "maternity";

    public const UNPAID = "unpaid";

    public const ALL_LEAVE_TYPES = [
        self::BEREAVEMENT,
        self::MATERNITY,
        self::PERSONAL,
        self::SICK,
        self::UNPAID,
        self::VACATION
    ];

}
