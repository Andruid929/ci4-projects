<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Entities\User;
use CodeIgniter\Shield\Models\UserModel;

class EmployeeUserModel extends UserModel
{
    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,
            "employee_id",
            "first_name",
            "last_name"
        ];
    }

    public function getUserByEmployeeId(string $employeeId): User|null
    {
        $record = $this->where('employee_id', $employeeId)->first();

        if ($record) {
            return $record;
        }

        return null;
    }
}
