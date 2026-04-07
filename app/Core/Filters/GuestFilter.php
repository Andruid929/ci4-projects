<?php

namespace App\Core\Filters;

use App\Util\RedirectUtil;
use CodeIgniter\Filters\FilterInterface;

class GuestFilter implements FilterInterface
{
    public function before($request, $arguments = null)
    {
        if (!session()->get("isLoggedIn")) {
            return RedirectUtil::redirectWithErrors("/",
             ["You must be logged in to access the dashboard"]);
        }
    }

    public function after($request, $response, $arguments = null)
    {
    }
}