<?php

namespace App\Core\Filters\Auth;

use App\Util\RedirectUtil;
use \CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before($request, $arguments = null)
    {
        if (session()->get("role") && session()->get("role") !== "admin") {
            return RedirectUtil::redirectWithErrors("dashboard", ["You don't have permission to access the admin dashboard."]);
        }
    }

    public function after($request, $response, $arguments = null)
    {
    }
}