<?php

namespace App\Modules\Employees\Controllers;

use App\Controllers\BaseController;
use App\Modules\Employees\Services\EmployeeService;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LoggerInterface;

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
        $data = $this->request->getPost();

        // Basic validation could go here, but focusing on AJAX submission as requested
        $result = $service->createEmployee($data);

        if ($result) {
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

}