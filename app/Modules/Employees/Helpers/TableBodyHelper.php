<?php

namespace App\Modules\Employees\Helpers;

class TableBodyHelper
{
    
    public static function renderTableBody(array $employees, string $itemUrlPrefix)
    {
        if (count($employees) === 0): ?>
            
            <tr>
                <td colspan="5" class="text-center">No employees found.</td>
            </tr>
        
        <?php else:
            foreach ($employees as $employee): ?>
                
                <tr class="clickable-row"
                    onclick="window.location='<?= base_url($itemUrlPrefix . $employee['employee_id']) ?>'">
                    <td>
                        <?= $employee['employee_id'] ?>
                    </td>
                    <td>
                        <?= $employee['first_name'] . ' ' . $employee['last_name'] ?>
                    </td>
                    <td>
                        <?= $employee['email'] ?>
                    </td>
                    <td>
                        <?= $employee['department'] ?>
                    </td>
                    <td>
                        <span class="badge <?= StatusColourHelper::getStatusColour($employee['status']) ?>">
                            <?= $employee['status'] ?>
                        </span>
                    </td>
                </tr>
            
            <?php
            endforeach;
        endif;
    }
}