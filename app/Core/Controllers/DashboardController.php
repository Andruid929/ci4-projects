<?php

namespace App\Core\Controllers;

use App\Controllers\BaseController;
use App\Helpers\GroupsHelper;
use App\Modules\InternalRequest\Models\InternalRequestModel;
use App\Modules\LeaveRequests\Models\LeaveRequestsModel;

class DashboardController extends BaseController
{

    public function showDashboard(string $group = "user"): string
    {
        $user = auth()->user();
        $internalRequestModel = new InternalRequestModel();
        $leaveRequestModel = new LeaveRequestsModel();

        if ($group === GroupsHelper::ADMIN || $group === GroupsHelper::MANAGER) {
            $internalRequests = $internalRequestModel->findAll();

            $leaveRequests = $leaveRequestModel->findAll();
        } else {
            $employeeId = $user->employee_id ?? null;

            if ($employeeId) {
                $internalRequests = $internalRequestModel->where('employee_id', $employeeId)->findAll();
                $leaveRequests = $leaveRequestModel->where('employee_id', $employeeId)->findAll();
            } else {
                $internalRequests = [];
                $leaveRequests = [];
            }
        }

        return view('dashboard', [
            'internalRequests' => $internalRequests,
            'leaveRequests'    => $leaveRequests,
            'user'             => $user
        ]);
    }
}
