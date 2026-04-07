<?php

namespace App\Core\Filters\Auth;

use \CodeIgniter\Filters\FilterInterface;

class StandardFilter implements FilterInterface
{
    public function before($request, $arguments = null)
    {
        if (session()->get("role") && session()->get("role") === "admin") {
            return redirect()->to("admin/dashboard");
        }
    }

    public function after($request, $response, $arguments = null)
    {
    }
}