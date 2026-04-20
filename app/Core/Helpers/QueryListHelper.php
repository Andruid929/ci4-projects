<?php

namespace App\Core\Helpers;

use App\Core\Models\CoreModel;
use App\Modules\Projects\Models\ProjectModel;
use App\Modules\Tasks\Models\TaskModel;

class QueryListHelper
{

    public static function queryList(string $db): array
    {
        $model = self::getModel($db);

        $array = $model->getAll();

        if ($array) {
            return $array;
        }

        return [];
    }

    private static function getModel(string $dbName): CoreModel
    {
        if ($dbName === "Project") {
            return new ProjectModel();
        } elseif ($dbName === "Task") {
            return new TaskModel();
        } else {
            return new CoreModel();
        }
    }
}