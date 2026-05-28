<?php

namespace App\Modules\LeaveRequests\Controllers;

use App\Core\Controllers\CoreRequestController;
use App\Modules\LeaveRequests\Models\LeaveRequestsModel;

class LeaveRequestsController extends CoreRequestController
{
    public function __construct()
    {
        $this->model = new LeaveRequestsModel();
    }
}
