<?php

namespace App\Core\Models;

use App\Core\Helper\StatusHelper;
use CodeIgniter\Model;

class CoreModel extends Model
{

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $updatedField = "updated_at";
    protected $createdField = "created_at";
    protected $deletedField = "deleted_at";

    protected $allowedFields = [
        "employee_id",
        "status",
        "approver_comment",
        "updated_at",
        "created_at",
        "deleted_at"
    ];

    public function getAllRequests(): array|null
    {
        return $this->findAll();
    }

    public function getManagedRequests(bool $pending = true): array|null
    {
        if ($pending) {
            return $this->where("approver_comment")
                ->where("status", StatusHelper::PENDING)
                ->findAll();
        }

        return $this->where("approver_comment !=")->findAll();
    }

    public function getRequestByEmployee(int $employeeId): array|null
    {
        return $this->where("employee_id", $employeeId)->findAll();
    }

    public function getRequestByStatus(string $status): array|null
    {
        return $this->where("status", $status)->findAll();
    }
}
