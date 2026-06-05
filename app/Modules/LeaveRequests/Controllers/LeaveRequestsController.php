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
        return [
            "request_type" => "required",
            "start_date" => "required|valid_date",
            "end_date" => "required|valid_date",
            "reason" => "required",
        ];
    }

    protected function validationErrorMessages(): array
    {
        return [
            "request_type" => [
                "required" => "The type of request is required"
            ],
            "reason" => [
                "required" => "Reason is required",
            ],
            "start_date" => [
                "required" => "The starting date is required",
                "valid_date" => "Please provide a valid starting date"
            ],
            "end_date" => [
                "required" => "The leave end date is required",
                "valid_date" => "Please provide a valid end date"
            ],
        ];
    }

    protected function getService(): CoreService
    {
        return new LeaveRequestsService();
    }
}
