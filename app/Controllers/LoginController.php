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
        $loginInfo = [
            "email" => $this->request->getPost("email"),
            "password" => $this->request->getPost("password")
        ];

        if (! auth()->attempt($loginInfo)) {
            return redirect("login")
            ->withInput()
            ->with("errors", $this->validator->getErrors());
        }

        if (auth()->user()->inGroup('admin')) {
            return redirect("dashboard/admin");
        } elseif (auth()->user()->inGroup('manager')) {
            return redirect("dashboard/manager");
        }
        
        return redirect("dashboard/user");
    }

}
