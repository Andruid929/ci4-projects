<?php

namespace App\Controllers;

use App\Helpers\GroupsHelper;
use App\Helpers\EmployeeCodeHelper;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Controllers\RegisterController as ShieldRegisterController;
use CodeIgniter\Shield\Entities\User;

class RegisterController extends ShieldRegisterController
{

    public function index(): string
    {
        return view("register");
    }

    public function registerAction(): RedirectResponse
    {
        $users = auth()->getProvider();

        $employeeCode = EmployeeCodeHelper::generateEmployeeCode();

        log_message("error", "Generated employee code: " . $employeeCode);

        $user = new User([
            "username" => $employeeCode,
            "email" => $this->request->getPost("email"),
            "password" => $this->request->getPost("password"),
        ]);

        $user->addGroup(GroupsHelper::USER);

        try {
            $users->save($user);

        } catch (\Throwable $e) {
            log_message("error", "Error creating user: " . $e->getMessage());

            return redirect("register")
                ->withInput()
                ->with("error", "Something went wrong on our end. Please try again.");
        }

        return redirect("login")
            ->withInput()
            ->with("success", "Account created successfully, use your credentials to login");
    }

}
