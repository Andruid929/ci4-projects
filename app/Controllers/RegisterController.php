<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Controllers\RegisterController as ShieldRegisterController;

class RegisterController extends ShieldRegisterController
{
    public function registerAction(): RedirectResponse
    {
        $rules = [
            "email" => "required|valid_email|is_unique[users.email]",
            "password" => "required|min_length[8]",
        ];

        if (!$this->validate($rules)) {
            return redirect("register")
                ->withInput()
                ->with("errors", $this->validator->getErrors());
        }

        $email = $this->request->getPost("email");

        $auth = service("auth");
        $auth->register([
            "email" => $email,
            "username" => $email,
            "password" => $this->request->getPost("password")
        ]);

        return redirect()->to("login");
    }

    public function showRegisterForm(): string
    {
        return view("register");
    }
}