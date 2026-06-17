<?php

namespace App\Modules\LeaveRequests\Services;

use App\Core\Models\CoreModel;
use App\Core\Services\CoreService;
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

        return parent::createRequest($data);
    }


}
