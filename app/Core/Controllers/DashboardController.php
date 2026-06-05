<?php

namespace App\Core\Controllers;

use App\Controllers\BaseController;
use App\Helpers\RolesHelper;
use App\Modules\InternalRequests\Services\InternalRequestsService;
use App\Modules\LeaveRequests\Services\LeaveRequestsService;

class DashboardController extends BaseController
{

    public function admin(): string
    {
        return $this->showDashboard(RolesHelper::ADMIN);
    }

    public function manager(): string
    {
        return $this->showDashboard(RolesHelper::MANAGER);
    }

    public function index(): string
    {
        return $this->showDashboard();
    }

    private function showDashboard(string $group = "user"): string
    {
        $user = auth()->user();

        $interReqsService = new InternalRequestsService();
        $leaveRequestService = new LeaveRequestsService();

        $deletedParam = $this->request->getGet("page");

        $viewDeleted = $deletedParam === "deleted";

        if ($group === RolesHelper::ADMIN || $group === RolesHelper::MANAGER) {

            if ($viewDeleted) {
                $internalRequests = $interReqsService->getDeletedRequests();

                $leaveRequests = $leaveRequestService->getDeletedRequests();

            } else {
                $internalRequests = $interReqsService->getAllRequests();

                $leaveRequests = $leaveRequestService->getAllRequests();
            }
        } else {

            if ($viewDeleted) {
                redirect("dashboard");
            }

            $employeeId = $user->employee_id ?? null;

            if ($employeeId) {
                $internalRequests = $interReqsService->getEmployeeRequests($employeeId);
                $leaveRequests = $leaveRequestService->getEmployeeRequests($employeeId);

            } else {
                $internalRequests = [];
                $leaveRequests = [];
            }
        }

        return view('dashboard', [
            "internalRequests" => $internalRequests,
            "leaveRequests" => $leaveRequests,
            "user" => $user,
            "viewDeleted" => $viewDeleted
        ]);
    }
}
