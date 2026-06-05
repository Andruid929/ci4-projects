<?php

namespace App\Core\Models;

use App\Core\Helper\StatusHelper;
use CodeIgniter\Model;

class CoreModel extends Model
{

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;

    protected $primaryKey = "id";

    protected $updatedField = "updated_at";
    protected $createdField = "created_at";
    protected $deletedField = "deleted_at";

    protected $allowedFields = [
        "employee_id",
        "status",
        "approver_id",
        "approver_comment",
        "updated_at",
        "created_at",
        "deleted_at"
    ];

    public function getManagedRequests(bool $pending = true): array|null
    {
        if ($pending) {
            return $this->where("approver_comment")
                ->where("status", StatusHelper::PENDING)
                ->findAll();
        }


        return $this->where("approver_comment !=")->findAll();
    }

    public function getRequestByEmployee(string $employeeId): array|null
    {
        return $this->where("employee_id", $employeeId)->findAll();
    }

    public function getRequestByStatus(string $status): array|null
    {
        return $this->where("status", $status)->findAll();
    }

    public function findIncludingDeleted(int $id)
    {
        return $this->withDeleted()->find($id);
    }

    public function getRequestsManagedBy(string $employee_id): array|null
    {
        return $this->where("approver_id", $employee_id)->findAll();
    }
}
