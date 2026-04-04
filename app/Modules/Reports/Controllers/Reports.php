<?php

namespace App\Modules\Reports\Controllers;

use App\Core\Common\Controllers\HelpDeskController;

class Reports extends HelpDeskController
{

    public function daily()
    {
        echo "<h1>This is the daily report</h1>";
    }

    public function user(string $username = "Unknown")
    {
        echo "<h1>This is the report for $username</h1>";
    }

    public function summary()
    {
        echo "<h1>This is the report summary</h1>";
    }
}