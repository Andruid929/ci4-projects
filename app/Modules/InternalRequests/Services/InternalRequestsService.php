<?php

namespace App\Modules\InternalRequests\Services;

use App\Core\Models\CoreModel;
use App\Core\Services\CoreService;
use App\Modules\InternalRequests\Models\InternalRequestModel;

class InternalRequestsService extends CoreService
{

    protected function getModel(): CoreModel
    {
        return model(InternalRequestModel::class);
    }
}
