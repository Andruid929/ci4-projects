<?php

namespace App\Modules\Employees\Controllers;

use App\Controllers\BaseController;
use App\Modules\Employees\Helpers\ValidationHelper;
use App\Modules\Employees\Services\EmployeeService;
use CodeIgniter\HTTP\RedirectResponse;

class EmployeeController extends BaseController
{

    protected EmployeeService $employeeService;

    public function __construct()
    {
        $this->employeeService = new EmployeeService();
    }

    public function view(int $employeeId): string|RedirectResponse
    {
        $employee = $this->employeeService->getEmployeeById($employeeId);

        if (!$employee) {
            return redirect()->to("dashboard")->with("error", "Employee not found.");
        }

        $firstName = $employee["first_name"];
        $lastName = $employee["last_name"];

        $data = [
            "employeeId" => $employee["employee_id"],
            "employeeCode" => $employee["employee_code"],
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $employee["email"],
            "phoneNumber" => $employee["phone_number"],
            "gender" => $employee["gender"],
            "department" => $employee["department"],
            "jobTitle" => $employee["job_title"],
            "employmentType" => $employee["employment_type"],
            "status" => $employee["status"],
            "dateJoined" => $employee["date_joined"],
            "probationEndDate" => $employee["probation_end_date"],
            "pageName" => $firstName . " " . $lastName
        ];

        return view('App\Modules\Employees\Views\employee', $data);
    }

    public function create()
    {
        if ($this->isRequestInfoInvalid()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => implode(', ', $this->validator->getErrors())
            ])->setStatusCode(400);
        }

        $data = $this->request->getPost();

        $result = $this->employeeService->createEmployee($data);

        if ($result) {
            $this->employeeService->updateEmployeeCode($result);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Employee created successfully.',
                'redirect' => base_url('dashboard')
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to create employee.'
        ])->setStatusCode(400);
    }

    public function update(int $id)
    {
        if ($this->isRequestInfoInvalid()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => implode(', ', $this->validator->getErrors())
            ])->setStatusCode(400);
        }

        $data = $this->request->getPost();

        $result = $this->employeeService->updateEmployee($id, $data);

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Employee updated successfully.',
                'redirect' => base_url('employee/' . $id)
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to update employee.'
        ])->setStatusCode(400);
    }

    public function delete(int $id)
    {
        $result = $this->employeeService->deleteEmployee($id);

        if ($result) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Employee deleted successfully.',
                'redirect' => base_url('dashboard')
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to delete employee.'
        ])->setStatusCode(400);
    }

    public function restore(int $id)
    {
        $result = $this->employeeService->getDeletedEmployee($id);

        if ($result) {
            $this->employeeService->restoreEmployee($id);

            return $this->response->setJSON([
                'success' => true,
                'message' => 'Employee restored successfully.',
                'redirect' => base_url('employee/' . $id)
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to restore employee.'
        ])->setStatusCode(400);
    }

    public function viewDeleted(int $employeeId): string|RedirectResponse
    {
        $employee = $this->employeeService->getDeletedEmployee($employeeId);

        if (!$employee) {
            return redirect()->to("dashboard?p=deleted")->with("error", "Employee not found.");
        }

        $firstName = $employee["first_name"];
        $lastName = $employee["last_name"];

        $data = [
            "employeeId" => $employee["employee_id"],
            "employeeCode" => $employee["employee_code"],
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $employee["email"],
            "phoneNumber" => $employee["phone_number"],
            "gender" => $employee["gender"],
            "department" => $employee["department"],
            "jobTitle" => $employee["job_title"],
            "employmentType" => $employee["employment_type"],
            "status" => $employee["status"],
            "dateJoined" => $employee["date_joined"],
            "probationEndDate" => $employee["probation_end_date"],
            "pageName" => $firstName . " " . $lastName,
            "isDeletedView" => true
        ];

        return view('App\Modules\Employees\Views\employee', $data);
    }

    protected function isRequestInfoInvalid(): bool
    {
        return !$this->validate(ValidationHelper::getValidationRules(), ValidationHelper::getValidationErrorMessages());
    }
}