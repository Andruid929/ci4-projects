<?php

declare(strict_types=1);

namespace App\Models;

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
}
