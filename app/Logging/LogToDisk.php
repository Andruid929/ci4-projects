<?php

namespace App\Logging;

class LogToDisk
{

    public static function logSignInAttempt(array $info = [])
    {
        log_message("warning", "Failed sign-in attempt with '{email}' from {ip_address} | {browser}",
        $info);
    }
    
    public static function logSignIn(array $info = [])
    {
        log_message("info", "Successful sign-in with '{email}' from IP {ip_address} | {browser}",
        $info);
    }

    public static function logSignOut(array $info = [])
    {
        log_message("info", "User with email '{email}' signed out from IP {ip_address} | {browser}",
        $info);
    }

    public static function logUnauthorizedAccess(array $info = [])
    {
        log_message("warning", "Unauthorized access attempt to '{endpoint}' from IP {ip_address} | {browser}",
        $info);
    }

    public static function logAuthenticationFailure(array $info = [])
    {
        log_message("warning", "Authentication failure for email '{email}' from IP {ip_address} | {browser}",
        $info);
    }

}