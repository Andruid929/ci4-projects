<?php

namespace App\Core\Home\Controllers;

use App\Core\Common\Controllers\HelpDeskController;

class Home extends HelpDeskController
{

    public function index()
    {
        echo "<h1>Welcome to Helpdesk Lite</h1>";
    }
    
}