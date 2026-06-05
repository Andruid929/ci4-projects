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

    public function getRequestById(int $id)
    {
        return $this->coreModel->find($id);
    }

    public function getRequestByIdIncludingDeleted(int $id)
    {
        return $this->coreModel->findIncludingDeleted($id);
    }

    public function createRequest(array $data): int
    {
        return $this->coreModel->insert($data);
    }

    public function editRequest(int $id, array $data): bool
    {
        return $this->coreModel->update($id, $data);
    }

    public function getAllRequests(bool $includeDeleted = false): array|null
    {
        if ($includeDeleted) {
            return $this->coreModel->withDeleted()->findAll();
        }

        return $this->coreModel->findAll();
    }

    public function getAllManagedRequests(): array|null
    {
        return $this->coreModel->getManagedRequests(false);
    }

    public function getPendingRequests(): array|null
    {
        return $this->coreModel->getManagedRequests();
    }

    public function getManagedRequests(bool $approved = true): array|null
    {
        if ($approved) {

            return $this->coreModel->where("status", StatusHelper::APPROVED)->findAll();
        }

        return $this->coreModel->where("status", StatusHelper::DENIED)->findAll();
    }

    public function getDeletedRequests(): array|null
    {
        return $this->coreModel->onlyDeleted()->findAll();
    }

    public function getEmployeeRequests(string $employeeId): array|null
    {
        return $this->coreModel->getRequestByEmployee($employeeId);
    }

    public function updateRequestStatus(int $id, string $status, string $comment): bool
    {
        $data = [
            'status' => $status,
            'approver_id' => auth()->user()->employee_id,
            'approver_comment' => $comment
        ];

        return $this->coreModel->update($id, $data);
    }

    public function deleteRequest(int $id): bool
    {
        return $this->coreModel->delete($id);
    }

    public function restoreRequest(int $id): bool
    {
        return $this->coreModel->restore($id);
    }

    protected function getModel(): CoreModel
    {
        return model(CoreModel::class);
    }
}
