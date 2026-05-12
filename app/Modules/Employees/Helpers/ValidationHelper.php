<?php

namespace App\Modules\Employees\Helpers;

class ValidationHelper
{

    public static function getValidationRules(): array
    {
        return [
            "first_name" => "required|min_length[3]|max_length[30]",
            "last_name" => "required|min_length[3]|max_length[30]",
            "email" => "required|valid_email|max_length[255]",
            "phone_number" => "required|max_length[25]|regex_match[^\+?[\d\s\-()]{1,25}$]",
            "department" => "required|min_length[2]|max_length[20]",
            "job_title" => "required|min_length[2]|max_length[20]|string",
            "gender" => "required|in_list[m, f, r]",
            "employment_type" => "required|in_list[full-time,part-time,contract]",
            "status" => "required|in_list[active,inactive,terminated]",
            "date_joined" => "required|valid_date[Y-m-d\TH:i]",
            "probation_end_date" => "required|valid_date[Y-m-d\TH:i]"
        ];
    }

    public static function getValidationErrorMessages(): array
    {
        return [
            "first_name" => [
                "required" => "First name is required.",
                "min_length" => "First name must be at least 3 characters.",
                "max_length" => "First name cannot exceed 30 characters."
            ],
            "last_name" => [
                "required" => "Last name is required.",
                "min_length" => "Last name must be at least 3 characters.",
                "max_length" => "Last name cannot exceed 30 characters."
            ],
            "email" => [
                "required" => "Email is required.",
                "valid_email" => "Please provide a valid email address.",
                "max_length" => "Email cannot exceed 255 characters."
            ],
            "phone_number" => [
                "required" => "Phone number is required.",
                "max_length" => "Phone number cannot exceed 25 characters.",
                "regex_match" => "Please provide a valid phone number."
            ],
            "department" => [
                "required" => "Department is required.",
                "min_length" => "Department must be at least 2 characters.",
                "max_length" => "Department cannot exceed 20 characters."
            ],
            "job_title" => [
                "required" => "Job title is required.",
                "min_length" => "Job title must be at least 2 characters.",
                "max_length" => "Job title cannot exceed 20 characters."
            ],
            "gender" => [
                "required" => "Gender is required.",
                "in_list" => "Please select a valid gender."
            ],
            "employment_type" => [
                "required" => "Employment type is required.",
                "in_list" => "Please select a valid employment type."
            ],
            "status" => [
                "required" => "Status is required.",
                "in_list" => "Please select a valid status."
            ],
            "date_joined" => [
                "required" => "Date joined is required.",
                "valid_date" => "Please provide a valid date for date joined."
            ],
            "probation_end_date" => [
                "required" => "Probation end date is required.",
                "valid_date" => "Please provide a valid date for probation end date."
            ]
        ];
    }
}