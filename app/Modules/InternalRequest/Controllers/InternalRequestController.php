<?php

namespace App\Modules\InternalRequest\Controllers;

use App\Core\Controllers\CoreRequestController;
use App\Modules\InternalRequest\Models\InternalRequestModel;

class InternalRequestController extends CoreRequestController
{
    public function __construct()
    {
        $this->model = new InternalRequestModel();
    }
}
