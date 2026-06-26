<?php

namespace App\Modules\InternalRequests\Services;

use App\Core\Helper\RequestTypeValidationHelper;
use App\Core\Models\CoreModel;
use App\Core\Services\CoreService;
use App\Modules\InternalRequests\Helpers\InternalRequestTypeHelper;
use App\Modules\InternalRequests\Models\InternalRequestModel;

class InternalRequestsService extends CoreService
{

    protected function getModel(): CoreModel
    {
        return model(InternalRequestModel::class);
    }

    public function createRequest(array $data): int
    {
        $validValues = InternalRequestTypeHelper::ALL_REQUEST_TYPES;

        $internalRequest = $data["request_type"];

        if(RequestTypeValidationHelper::isInvalid($validValues, $internalRequest)) {
            return -1;
        }

        return parent::createRequest($data);
    }
}
