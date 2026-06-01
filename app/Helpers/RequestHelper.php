<?php

namespace App\Helpers;

//Simpe formatting for page elements
class RequestHelper
{

    public static function formatStatus(string $status): string
    {
        return ucfirst(strtolower($status));
    }

    public static function formatLeaveType(string $type): string
    {
        $map = [
            'career_advancement' => 'Career advancement',
            'compensation' => 'Compensation',
            'operational' => 'Operational',
            'administrative' => 'Administrative',
            'sick' => 'Sick leave',
            'vacation' => 'Vacation',
            'personal' => 'Personal leave',
            'bereavement' => 'Bereavement leave',
            'maternity' => 'Maternity leave',
            'unpaid' => 'Unpaid leave'
        ];

        return $map[strtolower($type)] ?? ucwords(str_replace(['_', '-'], ' ', strtolower($type)));
    }

    public static function formatDate(?string $date, string $format = 'M d, Y'): string
    {
        if (empty($date)) {
            return '-';
        }
        
        try {
            return date($format, strtotime($date));
        } catch (\Exception $e) {
            return $date;
        }
    }

    public static function formatDateTime(?string $datetime, string $format = 'M d, Y H:i'): string
    {
        if (empty($datetime)) {
            return '-';
        }

        try {
            return date($format, strtotime($datetime));
        } catch (\Exception $e) {
            return $datetime;
        }
    }
}
