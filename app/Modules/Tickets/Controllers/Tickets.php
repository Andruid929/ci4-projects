<?php

namespace App\Modules\Tickets\Controllers;

use App\Core\Common\Controllers\HelpDeskController;

class Tickets extends HelpDeskController
{

    public function index()
    {
        echo "<h1>This is the tickets page</h1>";
    }

    public function new()
    {
        echo "<h1>Create a new ticket</h1>";
    }

    public function save()
    {
        echo "<h1>Save a new ticket</h1>";
    }

    public function view(int $ticketNumber = -1)
    {
        echo "<h1>You are viewing ticket #$ticketNumber</h1>";
    }

    public function edit(int $ticketNumber = -1)
    {
        echo "<h1>You are editing ticket #$ticketNumber</h1>";
    }
}