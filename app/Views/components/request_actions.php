<?php
use App\Helpers\RolesHelper;
?>
<div class="btn-group" role="group">
    <button title="View" class="btn btn-sm btn-info btn-view-generic" data-id="<?= $request['id'] ?>" data-target="#<?= $viewModalId ?>"><i class="fas fa-eye"></i></button>
    
    <?php
    if ($user->inGroup(RolesHelper::ADMIN)): ?>
        <button title="Restore" class="btn btn-sm btn-warning btn-restore-generic" data-id="<?= $request['id'] ?>"><i class="fas fa-undo"></i></button>
    
    <?php
    elseif ($user->inGroup(RolesHelper::ADMIN) || ($request['status'] === 'pending' && $request['employee_id'] === $user->employee_id)): ?>
        <button title="Edit" class="btn btn-sm btn-primary btn-edit-generic" data-id="<?= $request['id'] ?>" data-target="#<?= $editModalId ?>"><i class="fas fa-edit"></i></button>
        <button title="Delete" class="btn btn-sm btn-danger btn-delete-generic" data-id="<?= $request['id'] ?>"><i class="fas fa-trash"></i></button>
    
    <?php
    endif; ?>
    
    <?php
    if ($request['status'] === 'pending' && $user->inGroup(RolesHelper::ADMIN, RolesHelper::MANAGER)): ?>
        <button title="Approve/Deny" class="btn btn-sm btn-success btn-approve-generic" data-id="<?= $request['id'] ?>" data-target="#<?= $approveModalId ?>"><i class="fas fa-check-circle"></i></button>
    <?php
    endif; ?>
</div>
