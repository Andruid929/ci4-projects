<?php

namespace App\Util;

use CodeIgniter\HTTP\Exceptions\RedirectException;
use CodeIgniter\HTTP\RedirectResponse;

class RedirectUtil {

    private function __construct()
    {

    }

    public static function redirectBackWithErrors(array $errors) :RedirectResponse {
        return redirect()
            ->back()
            ->withInput()
            ->with("errors", $errors);
    }

    public static function redirectBack() :RedirectResponse {
        return redirect()
            ->back();
    }

    public static function redirectWithData(string $route, string $key, array $data) :RedirectResponse {
        return redirect($route)
            ->withInput()
            ->with($key, $data);
    }
    
    public static function redirectWithErrors(string $route, array $data) :RedirectResponse {
        return redirect($route)
            ->withInput()
            ->with("errors", $data);
    }
}