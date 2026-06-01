<?php
/**
 * @var array $requests
 * @var array $columns
 * @var string $tableId
 * @var string $title
 * @var string $buttonText
 * @var string $createModalId
 * @var array $actionModals
 */

use App\Helpers\RolesHelper;
use App\Helpers\UserHelper;
use App\Helpers\RequestHelper;

$user = auth()->user();
?>
<div class="card shadow mb-4">
    
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary"><?= esc($title) ?></h6>
        
        <button class="btn <?= str_contains(strtolower($title), 'leave') ? 'btn-success' : 'btn-primary' ?> shadow-sm"
                data-toggle="modal" data-target="#<?= $createModalId ?>">
            <i class="fas <?= str_contains(strtolower($title), 'leave') ? 'fa-calendar-plus' : 'fa-file-alt' ?> fa-sm text-white-50"></i> <?= esc($buttonText) ?>
        </button>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            
            <table class="table table-bordered" id="<?= $tableId ?>">
                <thead>
                
                <tr>
                    <?php
                    if ($user->inGroup(RolesHelper::ADMIN, RolesHelper::MANAGER)): ?>
                        <th>Employee</th>
                    <?php
                    endif; ?>
                    
                    <?php
                    foreach ($columns as $header => $field): ?>
                        <th><?= esc($header) ?></th>
                    <?php
                    endforeach; ?>
                    
                    <th>Status</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
                </thead>
                
                <tbody>
                
                <?php
                if (empty($requests)): ?>
                    <tr>
                        <td colspan="<?= (($user->inGroup(RolesHelper::ADMIN, RolesHelper::MANAGER)) ? 1 : 0) + count($columns) + 3 ?>"
                            class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            <strong>No requests</strong>
                        </td>
                    </tr>
                
                <?php
                else:
                    foreach ($requests as $request): ?>
                        <tr>
                            
                            <?php
                            if ($user->inGroup(RolesHelper::ADMIN, RolesHelper::MANAGER)): ?>
                                <td><?= UserHelper::getDisplayName($request['employee_id']) ?></td>
                            <?php
                            endif; ?>
                            
                            <?php
                            foreach ($columns as $header => $field): ?>
                                <td>
                                    
                                    <?php
                                    if ($field === 'request_type' || $field === 'leave_type') {
                                        echo esc(RequestHelper::formatLeaveType($request[$field]));
                                    } elseif ($field === 'start_date' || $field === 'end_date') {
                                        echo esc(RequestHelper::formatDate($request[$field]));
                                    } else {
                                        echo esc($request[$field]);
                                    }
                                    ?>
                                
                                </td>
                            
                            <?php
                            endforeach; ?>
                            
                            <td>
                                <span class="d-none"><?= esc($request['status']) ?></span>
                                <?= view('components/status_badge', ['status' => $request['status']]) ?>
                            </td>
                            
                            <td><?= esc(RequestHelper::formatDateTime($request['created_at'])) ?></td>
                            
                            <td>
                                <?= view('components/request_actions', [
                                        'request' => $request,
                                        'user' => $user,
                                        'viewModalId' => $actionModals['view'],
                                        'editModalId' => $actionModals['edit'],
                                        'approveModalId' => $actionModals['approve']
                                ]) ?>
                            </td>
                        
                        </tr>
                    
                    <?php
                    endforeach;
                endif; ?>
                
                </tbody>
            </table>
        </div>
    </div>
</div>
