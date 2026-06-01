<?php

namespace App\Modules\LeaveRequests\Controllers;

use App\Core\Controllers\CoreRequestController;
use App\Modules\LeaveRequests\Models\LeaveRequestsModel;

use App\Modules\LeaveRequests\Services\LeaveRequestsService;
use App\Core\Services\CoreService;

class LeaveRequestsController extends CoreRequestController
{

    protected function validationRules(): array
    {
        return array_merge(parent::validationRules(), [
            'start_date' => 'required|valid_date',
            'end_date'   => 'required|valid_date',
            'reason'     => 'required',
        ]);
    }

    protected function validationErrorMessages(): array
    {
        return array_merge(parent::validationErrorMessages(), [
            'reason' => 'Reason is required'
        ]);
    }

    protected function getService(): CoreService
    {
        return new LeaveRequestsService();
    }
}
