<?php

namespace App\Modules\Employees\Controllers;

use App\Controllers\BaseController;
use App\Modules\Employees\Helpers\EmployeeCodeHelper;
use App\Modules\Employees\Services\EmployeeService;
use CodeIgniter\HTTP\RedirectResponse;

class EmployeeController extends BaseController
{

    public function view(int $employeeId): string|RedirectResponse
    {
        $service = new EmployeeService();

        $employee = $service->getEmployeeById($employeeId);

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
        $service = new EmployeeService();

        if ($this->isRequestInfoInvalid()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => implode(', ', $this->validator->getErrors())
            ])->setStatusCode(400);
        }

        $data = $this->request->getPost();

        $result = $service->createEmployee($data);

        if ($result) {
            $service->updateEmployeeCode($result);

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
        $service = new EmployeeService();

        if ($this->isRequestInfoInvalid()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => implode(', ', $this->validator->getErrors())
            ])->setStatusCode(400);
        }

        $data = $this->request->getPost();

        $result = $service->updateEmployee($id, $data);

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

        $service = new EmployeeService();

        $result = $service->deleteEmployee($id);

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
        $service = new EmployeeService();

        $result = $service->getDeletedEmployee($id);

        if ($result) {
            return $this->response->setJSON([
                "success" => true,
                "message" => "Employee with id $id restored successfully",
                "redirect" => base_url("deleted")
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to restore employee.'
        ])->setStatusCode(400);
    }

    protected function isRequestInfoInvalid(): bool
    {
        return !$this->validate($this->validationRules(), $this->validationMessages());
    }

    protected function validationRules(): array
    {
        return [
            "first_name" => "required|min_length[3]|max_length[30]",
            "last_name" => "required|min_length[3]|max_length[30]",
            "email" => "required|valid_email|max_length[255]",
            "phone_number" => "required|max_length[25]|regex_match[^\+?[1-9]\d{1,14}([ -]?\d+)*$]",
            "department" => "required|min_length[2]|max_length[20]",
            "job_title" => "required|min_length[2]|max_length[20]|string",
            "gender" => "required|in_list[m, f, r]",
            "employment_type" => "required|in_list[full-time,part-time,contract]",
            "status" => "required|in_list[active,inactive,terminated]",
            "date_joined" => "required|valid_date[Y-m-d\TH:i]",
            "probation_end_date" => "required|valid_date[Y-m-d\TH:i]"
        ];
    }

    protected function validationMessages(): array
    {
        return [
            "first_name" => [
                "required" => "First name is required.",
                "min_length" => "First name must be at least 3 characters.",
                "max_length" => "First name cannot exceed 30 characters."
            ],
            "last_name" => [
                "required" => "Last name is required.",
                "min_length" => "Last name must be at least 3 characters.",
                "max_length" => "Last name cannot exceed 30 characters."
            ],
            "email" => [
                "required" => "Email is required.",
                "valid_email" => "Please provide a valid email address.",
                "max_length" => "Email cannot exceed 255 characters."
            ],
            "phone_number" => [
                "required" => "Phone number is required.",
                "max_length" => "Phone number cannot exceed 25 characters.",
                "regex_match" => "Please provide a valid phone number."
            ],
            "department" => [
                "required" => "Department is required.",
                "min_length" => "Department must be at least 2 characters.",
                "max_length" => "Department cannot exceed 20 characters."
            ],
            "job_title" => [
                "required" => "Job title is required.",
                "min_length" => "Job title must be at least 2 characters.",
                "max_length" => "Job title cannot exceed 20 characters."
            ],
            "gender" => [
                "required" => "Gender is required.",
                "in_list" => "Please select a valid gender."
            ],
            "employment_type" => [
                "required" => "Employment type is required.",
                "in_list" => "Please select a valid employment type."
            ],
            "status" => [
                "required" => "Status is required.",
                "in_list" => "Please select a valid status."
            ],
            "date_joined" => [
                "required" => "Date joined is required.",
                "valid_date" => "Please provide a valid date for date joined."
            ],
            "probation_end_date" => [
                "required" => "Probation end date is required.",
                "valid_date" => "Please provide a valid date for probation end date."
            ]
        ];
    }
}