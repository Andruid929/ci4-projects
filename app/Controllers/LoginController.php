<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Controllers\LoginController as ShieldLoginController;

class LoginController extends ShieldLoginController
{

    public function index(): string
    {
        return view("login");
    }

    public function loginAction(): RedirectResponse
    {
        $credentials = [
            "email" => $this->request->getPost("email"),
            "password" => $this->request->getPost("password")
        ];

        $result = auth()->authenticate($credentials);

        if (! $result->isOK()) {

            return redirect("login")
            ->withInput()
            ->with("error", $result->reason());
        }

        log_message("info", "");

        return redirect("dashboard");
    }

}
