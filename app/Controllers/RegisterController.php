<?php

namespace App\Controllers;

use App\Helpers\RolesHelper;
use App\Helpers\EmployeeIdHelper;
use App\Helpers\ValidationHelper;
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
        if (! $this->validate(ValidationHelper::userValidationRules(), ValidationHelper::userValidationErrorMessages())) {
            return redirect("register")
                ->withInput()
                ->with("errors", $this->validator->getErrors());
        }

        $users = auth()->getProvider();

        $employeeId = EmployeeIdHelper::generateEmployeeId();

        $user = new User([
            "username" => null,
            "employee_id" => $employeeId,
            "name" => "User registration",
            "email" => $this->request->getPost("email"),
            "password" => $this->request->getPost("password"),
            "first_name" => $this->request->getPost("first_name"),
            "last_name" => $this->request->getPost("last_name")
        ]);

        try {
            $users->save($user);

            $user = $users->findById($users->getInsertID());

            $users->addToDefaultGroup($user);
        } catch (\Throwable $e) {
            log_message("error", "Error creating user: " . $e->getMessage());

            return redirect("register")
                ->withInput()
                ->with("error", "Something went wrong on our end. Please try again.");
        }

        return redirect("login")
            ->withInput()
            ->with("message", "Account created successfully, use your credentials to login");
    }

}
