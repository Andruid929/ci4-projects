<?php

namespace App\Modules\Tasks\Models;

class TaskModel extends \App\Core\Models\CoreModel
{

    protected $table = "task";

    protected $primaryKey = 'task_id';

    protected $allowedFields = [
        "title",
        "project_code",
        "priority",
        "status",
        "notes",
        "due_date"
    ];

}