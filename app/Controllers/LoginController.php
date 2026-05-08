<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Controllers\LoginController as ShieldLoginController;

class LoginController extends ShieldLoginController
{
    public function loginAction(): RedirectResponse
    {
        $auth = service("auth");

        $requestInfo = [
            "email" => $this->request->getPost("email"),
            "password" => $this->request->getPost("password")
        ];

        if (!$auth->attempt($requestInfo)) {
            return redirect("login")
                ->withInput()
                ->with("error", "Invalid email or password");
        }

        return redirect("dashboard");
    }

    public function logoutAction(): RedirectResponse
    {
        $auth = service("auth");
        $auth->logout();

        return redirect("login");
    }

    public function showLoginForm(): string
    {
        return view("login");
    }
}