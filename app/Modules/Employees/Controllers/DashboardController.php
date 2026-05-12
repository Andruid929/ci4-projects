<?php

namespace App\Modules\Employees\Controllers;

use App\Controllers\BaseController;

use App\Modules\Employees\Models\EmployeeModel;
use App\Modules\Employees\Services\EmployeeService;

class DashboardController extends BaseController
{
    protected EmployeeService $employeeService;

    public function __construct()
    {
        $this->employeeService = new EmployeeService();
    }

    public function index(): string
    {
        $isRegularDashboard = $this->request->getGet("p") !== "deleted";

        $pageName = $isRegularDashboard ? "Employee Dashboard" : "Deleted Employees";

        $employees = $isRegularDashboard
            ? $this->employeeService->getEmployees()
            : $this->employeeService->getDeletedEmployees();

        return view('App\Modules\Employees\Views\dashboard', [
            "pageName" => $pageName,
            "employees" => $employees,
            "isRegularDashboard" => $isRegularDashboard
        ]);
    }

}