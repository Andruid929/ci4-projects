<?php

namespace App\Core\Auth\Controllers;

use App\Core\Common\Controllers\HelpDeskController;

class Auth extends HelpDeskController
{

    public function index()
    {
        echo "<h1>This is the auth</h1>";
    }

    public function attempt()
    {
        if ($this->request->getMethod() !== "POST") {
            redirect()->back();
        }

        return redirect("dashboard");
    }

}

