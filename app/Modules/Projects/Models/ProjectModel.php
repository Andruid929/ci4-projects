<?php

namespace App\Modules\Projects\Models;

class ProjectModel extends \App\Models\CoreModel
{

    protected $table = "project";

    protected $primaryKey = 'project_code';

    protected $allowedFields = [
        "title",
        "status",
        "description",
        "start_date"
    ];

}