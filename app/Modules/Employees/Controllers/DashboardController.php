<?php

namespace App\Modules\Employees\Controllers;

use App\Controllers\BaseController;

use App\Modules\Employees\Models\EmployeeModel;

class DashboardController extends BaseController
{

    public function index()
    {
        return view('App\Modules\Employees\Views\dashboard', ["pageName" => "Employee Dashboard"]);
    }

}