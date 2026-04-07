<?php

namespace App\Controllers;

class LogOut extends BaseController
{

    public function index()
    {
        session()->destroy();
        session()->setFlashdata("success", "You have been logged out successfully.");
        session()->set("isLoggedIn", false);
        
        return redirect()->to("/");
    }

}