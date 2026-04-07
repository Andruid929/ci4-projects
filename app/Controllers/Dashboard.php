<?php

namespace App\Controllers;

class Dashboard extends BaseController {

    public function index() {
        return view("dashboard");
    }

    public function admin() {
        return view("dashboard_admin"); 
    }

}