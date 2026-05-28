<?php

namespace App\Helpers;

class RequestModalHelper
{
    /**
     * Renders a modal for request actions
     * 
     * @param string $module The module name (InternalRequest, LeaveRequests)
     * @param string $type The type of modal (create, edit, view, approve)
     * @param array $data Optional data for the modal
     * @return string
     */
    public static function renderModal(string $module, string $type, array $data = []): string
    {
        return view("App\Modules\\$module\Views\modals\\" . $type, $data);
    }
}
