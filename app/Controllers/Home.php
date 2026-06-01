<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class Home extends BaseController
{
    public function index(): RedirectResponse
    {
        return auth()->loggedIn() ? redirect("dashboard") : redirect("login");
    }
}
