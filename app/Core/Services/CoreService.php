<?php

namespace App\Core\Services;

use App\Core\Helper\StatusHelper;
use App\Core\Models\CoreModel;

class CoreService
{

    protected CoreModel $coreModel;

    public function __construct()
    {
        $this->coreModel = $this->getModel();
    }

    public function getAllRequests(): array|null
    {
        return $this->coreModel->findAll();
    }

    public function getAllManagedRequests(): array|null
    {
        return $this->coreModel->getManagedRequests(false);
    }

    public function getPendingRequests(): array|null
    {
        return $this->coreModel->getManagedRequests(true);
    }

    public function getManagedRequests(bool $approved = true): array|null
    {
        if ($approved) {

            return $this->coreModel->where("status", StatusHelper::APPROVED)->findAll();
        }
        
        return $this->coreModel->where("status", StatusHelper::DENIED)->findAll();
    }

    public function getEmployeeRequests(int $employeeId): array|null
    {
        return $this->coreModel->getRequestByEmployee($employeeId);
    }

    public function updateRequestStatus(int $id, string $status, string $comment = null): bool
    {
        $data = [
            'status' => $status,
            'approver_comment' => $comment
        ];

        return $this->coreModel->update($id, $data);
    }

    protected function getModel(): CoreModel
    {
        return model(CoreModel::class);
    }
}
