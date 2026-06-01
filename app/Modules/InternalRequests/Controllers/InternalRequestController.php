<?php

namespace App\Modules\InternalRequests\Controllers;

use App\Core\Controllers\CoreRequestController;
use App\Core\Services\CoreService;
use App\Modules\InternalRequests\Services\InternalRequestsService;

class InternalRequestController extends CoreRequestController
{

    protected function validationRules(): array
    {
        return [
            'request_type' => 'required',
            'subject'      => 'required|max_length[30]',
            'description'  => 'required',
        ];
    }

    protected function validationErrorMessages(): array
    {
        return [
            'request_type' => 'Please specify the type of request you want',
            'subject' => [
                'required' => 'Subject is required',
                'max_length' => 'Subject is too long (max 30 characters)'
            ],
            'description' => 'Please describe why this request is necessary'
        ];
    }

    protected function getService(): CoreService
    {
        return service("internalRequestsService");
    }
}
