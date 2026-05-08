<?php

namespace App\Modules\Employees\Services;

use App\Modules\Employees\Models\EmployeeModel;

class EmployeeService
{

    private EmployeeModel $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }

    public function getAllEmployees(): array
    {
        $employees = $this->employeeModel->findAll();

        if ($employees) {
            return $employees;
        }

        return [];
    }

    public function getDeletedEmployees(): array
    {
        $deleted = $this->employeeModel->onlyDeleted()->findAll();

        if ($deleted) {
            return $deleted;
        }

        return [];
    }

    public function getEmployeeById(int $employeeId): ?array
    {
        $employee = $this->employeeModel->find($employeeId);

        if (!$employee) {
            return null;
        }

        return $employee;
    }

    public function createEmployee(array $data): bool|int|string
    {
        return $this->employeeModel->insert($data);
    }

    public function updateEmployee(int $id, array $data): bool
    {
        return $this->employeeModel->update($id, $data);
    }

    public function getDeletedEmployee(int $id): ?array
    {
        $deletedEmployee = $this->employeeModel->onlyDeleted()->find($id);

        if ($deletedEmployee) {
            return $deletedEmployee;
        }

        return null;
    }

    public function deleteEmployee(int $id): bool
    {
        $this->employeeModel->update($id, ['status' => 'terminated']);

        return $this->employeeModel->delete($id);
    }
}