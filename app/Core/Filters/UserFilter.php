<?php

namespace App\Core\Filters;

use CodeIgniter\Filters\FilterInterface;

class UserFilter implements FilterInterface
{
    public function before($request, $arguments = null)
    {
        if (session()->get("isLoggedIn")) {
            return redirect()->to("dashboard");
        }
    }

    public function after($request, $response, $arguments = null)
    {
    }
}