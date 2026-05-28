<?php
/** @var array $internalRequests */
/** @var array $leaveRequests */

use App\Helpers\RequestModalHelper;
use App\Helpers\GroupsHelper;

$this->extend("layouts/main");
?>

<?= $this->section("content") ?>

<div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    <div class="btn-group">
                        <button class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#createRequestModal">
                            <i class="fas fa-file-alt fa-sm text-white-50"></i> New Internal Request
                        </button>
                        <button class="btn btn-success shadow-sm" data-toggle="modal" data-target="#createLeaveModal">
                            <i class="fas fa-calendar-plus fa-sm text-white-50"></i> New Leave Request
                        </button>
                    </div>
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
                                            Internal Requests</div>
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
                                            Leave Requests</div>
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
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Internal Requests</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Type</th>
                                                <th>Subject</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($internalRequests as $request): ?>
                                                <tr>
                                                    <td><?= esc($request['employee_id']) ?></td>
                                                    <td><?= esc($request['request_type']) ?></td>
                                                    <td><?= esc($request['subject']) ?></td>
                                                    <td>
                                                        <span class="badge badge-<?= $request['status'] === 'approved' ? 'success' : ($request['status'] === 'pending' ? 'warning' : 'danger') ?>">
                                                            <?= esc($request['status']) ?>
                                                        </span>
                                                    </td>
                                                    <td><?= esc($request['created_at']) ?></td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <button title="View" class="btn btn-sm btn-info btn-view-generic" data-id="<?= $request['id'] ?>" data-target="#viewRequestModal"><i class="fas fa-eye"></i></button>
                                                            <?php if ($request['status'] === 'pending' && $request['employee_id'] === $user->employee_id): ?>
                                                                <button title="Edit" class="btn btn-sm btn-primary btn-edit-generic" data-id="<?= $request['id'] ?>" data-target="#editRequestModal"><i class="fas fa-edit"></i></button>
                                                                <button title="Delete" class="btn btn-sm btn-danger btn-delete-generic" data-id="<?= $request['id'] ?>"><i class="fas fa-trash"></i></button>
                                                            <?php endif; ?>
                                                            <?php if ($request['status'] === 'pending' && ($user->inGroup(GroupsHelper::ADMIN) || $user->inGroup(GroupsHelper::MANAGER))): ?>
                                                                <button title="Approve/Deny" class="btn btn-sm btn-success btn-approve-generic" data-id="<?= $request['id'] ?>" data-target="#approveRequestModal"><i class="fas fa-check-circle"></i></button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php if (empty($internalRequests)): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No internal requests found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Leave Requests Table -->
                    <div class="col-lg-12 mb-4" data-module="LeaveRequests" data-route="leave-requests">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Leave Requests</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Employee ID</th>
                                                <th>Type</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($leaveRequests as $request): ?>
                                                <tr>
                                                    <td><?= esc($request['employee_id']) ?></td>
                                                    <td><?= esc($request['leave_type']) ?></td>
                                                    <td><?= esc($request['start_date']) ?></td>
                                                    <td><?= esc($request['end_date']) ?></td>
                                                    <td>
                                                        <span class="badge badge-<?= $request['status'] === 'approved' ? 'success' : ($request['status'] === 'pending' ? 'warning' : 'danger') ?>">
                                                            <?= esc($request['status']) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <button title="View" class="btn btn-sm btn-info btn-view-generic" data-id="<?= $request['id'] ?>" data-target="#viewLeaveModal"><i class="fas fa-eye"></i></button>
                                                            <?php if ($request['status'] === 'pending' && $request['employee_id'] === $user->employee_id): ?>
                                                                <button title="Edit" class="btn btn-sm btn-primary btn-edit-generic" data-id="<?= $request['id'] ?>" data-target="#editLeaveModal"><i class="fas fa-edit"></i></button>
                                                                <button title="Delete" class="btn btn-sm btn-danger btn-delete-generic" data-id="<?= $request['id'] ?>"><i class="fas fa-trash"></i></button>
                                                            <?php endif; ?>
                                                            <?php if ($request['status'] === 'pending' && ($user->inGroup(GroupsHelper::ADMIN) || $user->inGroup(GroupsHelper::MANAGER))): ?>
                                                                <button title="Approve/Deny" class="btn btn-sm btn-success btn-approve-generic" data-id="<?= $request['id'] ?>" data-target="#approveLeaveModal"><i class="fas fa-check-circle"></i></button>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <?php if (empty($leaveRequests)): ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No leave requests found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->

<?= RequestModalHelper::renderModal('InternalRequest', 'create') ?>
<?= RequestModalHelper::renderModal('InternalRequest', 'edit') ?>
<?= RequestModalHelper::renderModal('InternalRequest', 'view') ?>
<?= RequestModalHelper::renderModal('InternalRequest', 'approve') ?>

<?= RequestModalHelper::renderModal('LeaveRequests', 'create') ?>
<?= RequestModalHelper::renderModal('LeaveRequests', 'edit') ?>
<?= RequestModalHelper::renderModal('LeaveRequests', 'view') ?>
<?= RequestModalHelper::renderModal('LeaveRequests', 'approve') ?>

<script src="<?= site_url('js/requests.js') ?>"></script>

<?= $this->endSection();
