<?php

namespace App\Core\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Util\RedirectUtil;

class Auth extends BaseController
{

    public function authenticateSignIn()
    {

        if ($this->request->getMethod() !== "POST") {
            return RedirectUtil::redirectWithErrors("login", ["Login required"]);
        }

        $rules = [
            "email" => "required|valid_email|max_length[50]",
            "password" => "required|min_length[8]|max_length[32]"
        ];

        $errorMessages = [
            "email" => [
                "valid_email" => "Please provide a valid email address"
            ],
            "password" => [
                "required" => "Password cannot be empty",
                "min_length" => "Password must be at least 8 characters",
                "max_length" => "Password cannot be longer than 32 characters"
            ]
        ];

        if ($this->validate($rules, $errorMessages)) {

            $givenEmail = $this->request->getPost("email");
            $givenPassword = $this->request->getPost("password");

            $userModel = new UserModel();

            if (!$userModel->userExists($givenEmail)) {
                return RedirectUtil::redirectBackWithErrors(["User not found"]);
            }

            if (!$userModel->verifyPassword($givenEmail, $givenPassword)) {
                return RedirectUtil::redirectBackWithErrors(["Invalid password"]);
            }

            $user = $userModel->getUserByEmail($givenEmail);

            $fullName = $user["first_name"] . " " . $user["last_name"];

            session()->set([
                "fullName" => $fullName,
                "id" => $user["id"],
                "emailAddress" => $user["email"],
                "role" => $user["role"],
                "lastActivity" => $user["last_activity"],
                "isLoggedIn" => true
            ]);

            return RedirectUtil::redirectWithData(
                "dashboard",
                "success",
                ["Welcome, " . $fullName]
            );

        } else {
            return RedirectUtil::redirectBackWithErrors($this->validator->getErrors());
        }

    }

    public function authenticateSignUp()
    {
        if ($this->request->getMethod() !== "POST") {
            return RedirectUtil::redirectWithErrors("signup", ["Account info required"]);
        }

        $rules = [
            "first-name" => "required|max_length[30]",
            "last-name" => "required|max_length[30]",
            "email" => "required|valid_email|max_length[50]|is_unique[portal_user.email]",
            "password" => "required|min_length[8]|max_length[32]",
            "confirm" => "required|matches[password]"
        ];

        $errorMessages = [
            "first-name" => [
                "required" => "First name required",
                "max_length" => "Name can not be longer than 30 characters"
            ],
            "last-name" => [
                "required" => "Last name required",
                "max_length" => "Name can not be longer than 30 characters"
            ],
            "email" => [
                "valid_email" => "Please provide a valid email address",
                "is_unique" => "Email already in use"
            ],
            "password" => [
                "required" => "Password cannot be empty",
                "min_length" => "Password must be at least 8 characters",
                "max_length" => "Password cannot be longer than 32 characters"
            ],
            "confirm" => [
                "required" => "Confirm your password",
                "matches" => "Passwords do not match"
            ]
        ];

        if ($this->validate($rules, $errorMessages)) {

            $data = [
                "first_name" => $this->getPost("first-name"),
                "last_name" => $this->getPost("last-name"),
                "email" => $this->getPost("email"),
                "password" => $this->getPost("password"),
                "last_activity" => date("Y-m-d H:i:s")
            ];

            $userModel = new UserModel();

            $userModel->save($data);

            return RedirectUtil::redirectWithData(
                "login",
                "success",
                ["Account creation successful, login with your account"]
            );

        } else {
            return RedirectUtil::redirectBackWithErrors($this->validator->getErrors());
        }

    }

    private function getPost(string $name)
    {
        return $this->request->getPost($name);
    }
}