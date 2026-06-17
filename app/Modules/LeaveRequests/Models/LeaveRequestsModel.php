<?php

namespace App\Modules\LeaveRequests\Models;

use App\Core\Models\CoreModel;
use CodeIgniter\Model;

class LeaveRequestsModel extends CoreModel
{

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
        return $this->where("request_type", $leaveType)->findAll();
    }

    protected function isLeaveRequest(): bool
    {
        return true;
    }


}
