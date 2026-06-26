<?php

namespace App\Modules\LeaveRequests\Services;

use App\Core\Helper\RequestTypeValidationHelper;
use App\Core\Models\CoreModel;
use App\Core\Services\CoreService;
use App\Modules\LeaveRequests\Helpers\LeaveRequestTypesHelper;
use App\Modules\LeaveRequests\Models\LeaveRequestsModel;

class LeaveRequestsService extends CoreService
{

    protected function getModel(): CoreModel
    {
        return model(LeaveRequestsModel::class);
    }

    public function createRequest(array $data): int
    {
        $data["is_leave"] = true;

        $validValues = LeaveRequestTypesHelper::ALL_LEAVE_TYPES;

        $leaveRequest = $data["request_type"];

        if(RequestTypeValidationHelper::isInvalid($validValues, $leaveRequest)) {
            return -1;
        }


        return parent::createRequest($data);
    }

    public function editRequest(int $id, array $data): bool
    {
        $validValues = LeaveRequestTypesHelper::ALL_LEAVE_TYPES;

        $leaveRequest = $data["request_type"];

        if(RequestTypeValidationHelper::isInvalid($validValues, $leaveRequest)) {
            return false;
        }

        return parent::editRequest($id, $data);
    }

}
