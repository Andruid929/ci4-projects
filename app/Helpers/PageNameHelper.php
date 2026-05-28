<?php

namespace App\Helpers;

class PageNameHelper
{

    public static function getPageName(): string
    {
        if (isset($pageName)) {
            return $pageName;
        }

        return match (current_url()) {
            url_to("login") => "Login now",
            url_to("register") => "Register now",
            default => "Employee Management"
        };
    }

}
