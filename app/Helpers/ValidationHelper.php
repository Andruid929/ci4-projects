<?php

namespace App\Helpers;

class ValidationHelper
{

    public static function userValidationRules(): array
    {
        return [
            "first_name" => "required|max_length[50]|min_length[2]|regex_match[/^[a-zA-Z\s\-\']+$/]",
            "last_name" => "required|max_length[50]|min_length[2]|regex_match[/^[a-zA-Z\s\-\']+$/]",
            "username" => "max_length[255]",
            "email" => "required|max_length[255]|valid_email",
            "password" => "required|min_length[8]|max_length[255]",
            "password_confirm" => "required|matches[password]"
        ];
    }

    public static function userValidationErrorMessages(): array
    {
        return [
            "first_name" => [
                "required" => "First name is required",
                "max_length" => "First name cannot exceed 50 characters",
                "min_length" => "First name cannot must be at least two characters",
                "regex_match" => "First name can only contain letters, hyphens and apostrophes"
            ],
            "last_name" => [
                "required" => "Last name is required",
                "max_length" => "Last name cannot exceed 50 characters",
                "min_length" => "Last name cannot must be at least two characters",
                "regex_match" => "Last name can only contain letters, hyphens and apostrophes"
            ],
            "email" => [
                "required" => "Email address is required",
                "max_length" => "Email cannot exceed 255 characters",
                "valid_email" => "Please enter a valid email",
            ],
            "password" => [
                "required" => "Password is required",
                "min_length" => "Password must be at least 8 characters",
                "max_length" => "Password cannot exceed 2525characters",
            ],
            "password_confirm" => [
                "required" => "Please confirm your password",
                "matches" => "Passwords do not match"
            ],

        ];
    }
}
