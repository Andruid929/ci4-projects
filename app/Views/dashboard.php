<?php
/**
 * @var array $internalRequests
 * @var array $leaveRequests
 * @var bool $viewDeleted
 */

use App\Helpers\RequestHelper;
use App\Helpers\RolesHelper;
use App\Helpers\UserHelper;

$this->extend("layouts/main");
?>

<?= $this->section("content") ?>

<?php $user = auth()->user(); ?>
    
    <div class="container-fluid">
        
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>
        
        <!-- Content Row -->
        <div class="row">
            
            <!-- Internal Requests Card -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Internal Requests
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($internalRequests) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Leave Requests Card -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Leave Requests
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= count($leaveRequests) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Content Row -->
        <div class="row">
            
            <!-- Internal Requests Table -->
            <div class="col-lg-12 mb-4" data-module="InternalRequest" data-route="internal-requests">
                
                <?= view('components/request_table', [
                        'requests' => $internalRequests,
                        'title' => 'Internal Requests',
                        'buttonText' => 'New Internal Request',
                        'tableId' => 'dataTableInternal',
                        'createModalId' => 'createRequestModal',
                        'columns' => [
                                'Type' => 'request_type',
                                'Subject' => 'subject',
                        ],
                        'actionModals' => [
                                'view' => 'viewRequestModal',
                                'edit' => 'editRequestModal',
                                'approve' => 'approveRequestModal'
                        ]
                ]) ?>
            
            </div>
            
            <!-- Leave Requests Table -->
            <div class="col-lg-12 mb-4" data-module="LeaveRequests" data-route="leave-requests">
                
                <?= view('components/request_table', [
                        'requests' => $leaveRequests,
                        'title' => 'Leave Requests',
                        'buttonText' => 'New Leave Request',
                        'tableId' => 'dataTableLeave',
                        'createModalId' => 'createLeaveModal',
                        'viewDeleted' => $viewDeleted,
                        'columns' => [
                                'Type' => 'leave_type',
                                'Start date' => 'start_date',
                                'End date' => 'end_date',
                        ],
                        'actionModals' => [
                                'view' => 'viewLeaveModal',
                                'edit' => 'editLeaveModal',
                                'approve' => 'approveLeaveModal'
                        ]
                ]) ?>
            
            </div>
        
        </div>
    
    </div>
    <!-- /.container-fluid -->
    
    <!-- Internal request modals -->
<?= view('components/modals/create', [
        'modalId' => 'createRequestModal',
        'title' => 'New Internal Request',
        'module' => 'InternalRequest',
        'route' => 'internal-requests',
        'type' => 'internal'
]) ?>
<?= view('components/modals/edit', [
        'modalId' => 'editRequestModal',
        'title' => 'Edit Internal Request',
        'module' => 'InternalRequest',
        'route' => 'internal-requests',
        'type' => 'internal'
]) ?>
<?= view('components/modals/view', [
        'modalId' => 'viewRequestModal',
        'title' => 'Request Details',
        'type' => 'internal'
]) ?>
<?= view('components/modals/approve', [
        'modalId' => 'approveRequestModal',
        'title' => 'Approve/Deny Request',
        'module' => 'InternalRequest',
        'route' => 'internal-requests'
]) ?>
    
    <!-- Leave request modals -->
<?= view('components/modals/create', [
        'modalId' => 'createLeaveModal',
        'title' => 'New Leave Request',
        'module' => 'LeaveRequests',
        'route' => 'leave-requests',
        'type' => 'leave'
]) ?>
<?= view('components/modals/edit', [
        'modalId' => 'editLeaveModal',
        'title' => 'Edit Leave Request',
        'module' => 'LeaveRequests',
        'route' => 'leave-requests',
        'type' => 'leave'
]) ?>
<?= view('components/modals/view', [
        'modalId' => 'viewLeaveModal',
        'title' => 'Leave Request Details',
        'type' => 'leave'
]) ?>
<?= view('components/modals/approve', [
        'modalId' => 'approveLeaveModal',
        'title' => 'Manage Leave Request',
        'module' => 'LeaveRequests',
        'route' => 'leave-requests'
]) ?>
    
    <script src="<?= site_url('js/ajax-requests.js') ?>"></script>

<?= $this->endSection();
