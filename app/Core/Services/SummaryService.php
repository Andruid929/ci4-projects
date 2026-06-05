<?php

namespace App\Core\Services;

use App\Helpers\UserHelper;
use App\Modules\InternalRequests\Models\InternalRequestModel;
use App\Modules\LeaveRequests\Models\LeaveRequestsModel;
use CodeIgniter\Config\BaseService;

class SummaryService extends BaseService
{

    /**
     * Get summary statistics for all requests
     */
    public function getStatistics(): array
    {
        $internalStats = $this->getModelStats(
            model(InternalRequestModel::class)
        );
        $leaveStats = $this->getModelStats(
            model(LeaveRequestsModel::class)
        );

        return [
            'total' => $internalStats['total'] + $leaveStats['total'],
            'pending' => $internalStats['pending'] + $leaveStats['pending'],
            'approved' => $internalStats['approved'] + $leaveStats['approved'],
            'denied' => $internalStats['denied'] + $leaveStats['denied'],
        ];
    }

    /**
     * Get recent requests from both types
     */
    public function getRecentRequests(int $limit = 10): array
    {
        $internalModel = model('App\Modules\InternalRequests\Models\InternalRequestModel');
        $leaveModel = model('App\Modules\LeaveRequests\Models\LeaveRequestsModel');

        // Get internal requests
        $internal = $internalModel
            ->withDeleted()
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();

        // Get leave requests
        $leave = $leaveModel
            ->withDeleted()
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();

        $requests = [];

        foreach ($internal as $req) {
            $requests[] = [
                'id' => $req['id'],
                'is_leave' => false,
                'employee_name' => UserHelper::getDisplayName($req['employee_id']),
                'status' => $req['status'],
                'created_at' => $req['created_at'],
            ];
        }

        foreach ($leave as $req) {
            $requests[] = [
                'id' => $req['id'],
                'is_leave' => true,
                'employee_name' => UserHelper::getDisplayName($req['employee_id']),
                'status' => $req['status'],
                'created_at' => $req['created_at'],
            ];
        }

        // Sort by created_at descending and limit
        usort($requests, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        return array_slice($requests, 0, $limit);
    }

    /**
     * Helper: Get stats from a model
     */
    private function getModelStats($model): array
    {
        $total = $model->countAllResults();
        $pending = $model->where('status', 'pending')->countAllResults();
        $approved = $model->where('status', 'approved')->countAllResults();
        $denied = $model->where('status', 'denied')->countAllResults();

        return [
            'total' => $total,
            'pending' => $pending,
            'approved' => $approved,
            'denied' => $denied,
        ];
    }
}
