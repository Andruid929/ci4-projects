<?php

namespace App\Modules\InternalRequests\Models;

use App\Core\Models\CoreModel;

class InternalRequestModel extends CoreModel
{

    protected $table = "inter_reqs";

    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,
            "request_type",
            "subject",
            "description"
        ];
    }

    public function getByRequestType(string $requestType): array|null
    {
        return $this->where("request_type", $requestType)->findAll();
    }
}
