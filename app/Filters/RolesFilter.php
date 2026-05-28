<?php

namespace App\Filters;

use App\Helpers\GroupsHelper;
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

        if ($user->inGroup(GroupsHelper::ADMIN) && $path !== "/dashboard/admin") {
            return redirect("dashboard/admin");

        } elseif ($user->inGroup(GroupsHelper::MANAGER) && $path !== "/dashboard/manager"){
            return redirect(GroupsHelper::MANAGER);

        } else {
            if ($path !== "/dashboard") {
                return redirect("dashboard");
            }

            return null;
        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
