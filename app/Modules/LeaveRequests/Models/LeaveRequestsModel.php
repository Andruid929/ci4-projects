<?php

namespace App\Modules\LeaveRequests\Models;

use App\Core\Models\CoreModel;

class LeaveRequestsModel extends CoreModel
{

    protected $table = "leave_apps";

    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,
            "start_date",
            "end_date",
            "reason"
        ];
    }

    public function getByLeaveType(string $leaveType): array|null
    {
        return $this->where("leave_type", $leaveType)->findAll();
    }

    
}