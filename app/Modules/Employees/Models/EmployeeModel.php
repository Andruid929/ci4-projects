<?php

declare(strict_types=1);

namespace App\Modules\Employees\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{

    protected $primaryKey = "employee_id";

    protected $table = "employees";

    protected $useSoftDeletes = true;

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $dateFormat = 'datetime';

    protected $allowedFields = [
        "employee_code",
        "first_name",
        "last_name",
        "email",
        "gender",
        "phone_number",
        "department",
        "job_title",
        "employment_type",
        "status",
        "date_joined",
        "probation_end_date",
        "last_updated",
        "deleted_at"
    ];

}