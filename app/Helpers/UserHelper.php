<?php

namespace App\Helpers;

use App\Models\EmployeeUserModel;

class UserHelper
{

    public static function getDisplayName(string $employeeId): string
    {
        $model = model(EmployeeUserModel::class);

        $user = $model->getUserByEmployeeId($employeeId);

        if (! $user) {
            return "Usernamme";
        }

        return $user->first_name . " " . $user->last_name;
    }

}
