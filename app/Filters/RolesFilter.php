<?php

namespace App\Filters;

use App\Helpers\RolesHelper;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RolesFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null): RedirectResponse|null
    {
        $user = auth()->user();

        $path = $request->getUri()->getPath();
        $path = '/' . ltrim($path, '/');

        if ($user->inGroup(RolesHelper::ADMIN)) {
            if ($path !== "/dashboard/admin") {
                return redirect()->to("dashboard/admin");
            }

            return null;
        }

        if ($user->inGroup(RolesHelper::MANAGER)) {
            if ($path !== "/dashboard/manager") {
                return redirect()->to("dashboard/manager");
            }

            return null;
        }

        if ($path !== "/dashboard") {
            return redirect()->to("dashboard");
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
