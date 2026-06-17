<?php

namespace App\Core\Models;

use App\Core\Helper\StatusHelper;
use CodeIgniter\Model;

class CoreModel extends Model
{

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $primaryKey = "id";

    protected $table = "requests";

    protected $updatedField = "updated_at";
    protected $createdField = "created_at";
    protected $deletedField = "deleted_at";

    protected $allowedFields = [
        "employee_id",
        "status",
        "approver_id",
        "approver_comment",
        "is_leave",
        "request_type",
        "updated_at",
        "created_at",
        "deleted_at"
    ];

    public function getManagedRequests(bool $pending = true): array|null
    {
        if ($pending) {
            return $this->getModelForRequests()
                ->where("approver_comment")
                ->where("status", StatusHelper::PENDING)
                ->findAll();
        }

        return $this->getModelForRequests()->where("approver_comment !=")->findAll();
    }

    public function getRequestByEmployee(string $employeeId): array|null
    {
        return $this->getModelForRequests()
            ->where("employee_id", $employeeId)
            ->findAll();
    }

    public function getRequestByStatus(string $status, bool $leaveRequests): array|null
    {
        return $this->getModelForRequests()
            ->where("status", $status)
            ->findAll();
    }

    public function findIncludingDeleted(int $id): array|object|null
    {
        return $this->getModelForRequests()
            ->withDeleted()
            ->find($id);
    }

    public function getRequestsManagedBy(string $employee_id): array|null
    {
        return $this->getModelForRequests()
            ->where("approver_id", $employee_id)
            ->findAll();
    }

    public function getModelForRequests(): Model
    {
        return $this->where("is_leave", $this->isLeaveRequest());
    }

    protected function isLeaveRequest(): bool
    {
        return false;
    }
}
