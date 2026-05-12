<?= $this->extend("layouts/main") ?>

<?= $this->section("content") ?>

<?php

use App\Modules\Employees\Helpers\DisplayHelper;
use App\Modules\Employees\Helpers\StatusColourHelper;

?>
    
    <div class="container mt-5 mb-5">
        <div class="card shadow-sm mb-4">
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Employee Code:</strong> <?= $employeeCode ?></p>
                        <p><strong>Email:</strong> <a href="mailto:<?= $email ?>"><?= $email ?></a></p>
                        <p><strong>Phone:</strong> <a href="tel:<?= $phoneNumber ?>"><?= $phoneNumber ?></a></p>
                        <p><strong>Gender:</strong> <?= DisplayHelper::displayGender($gender) ?></p>
                        <p><strong>Date hired:</strong> <?= date('M d, Y', strtotime($dateJoined)) ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Job Title:</strong> <?= $jobTitle ?></p>
                        <p><strong>Department:</strong> <span><?= $department ?></span></p>
                        <p><strong>Employment Type:</strong> <?= ucfirst($employmentType) ?></p>
                        <p><strong>Status:</strong> <span
                                    class="badge <?= StatusColourHelper::getStatusColour($status) ?>"><?= ucfirst($status) ?></span>
                        </p>
                        <p><strong>Probation ended:</strong> <?= date('M d, Y', strtotime($probationEndDate)) ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <?php if (isset($isDeletedView)): ?>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#restoreModal">
                        Restore
                    </button>
                <?php else: ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                        Edit Employee
                    </button>
                    
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        Delete Employee
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!--Confirm deletion-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete employee <strong><?= $firstName . ' ' . $lastName ?></strong>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Confirm restoration -->
    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="restoreModalLabel">Confirm Restoration</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to restore employee <strong><?= esc($firstName . ' ' . $lastName) ?></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmRestoreBtn" class="btn btn-success">
                        <i class="bi bi-arrow-counterclockwise"></i> Restore
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <!--Bring up a form to edit existing employee data -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <?php
                    $employeeData = [
                            'employee_id' => $employeeId,
                            'employee_code' => $employeeCode,
                            'first_name' => $firstName,
                            'last_name' => $lastName,
                            'email' => $email,
                            'phone_number' => $phoneNumber,
                            'gender' => $gender,
                            'department' => $department,
                            'job_title' => $jobTitle,
                            'employment_type' => $employmentType,
                            'status' => $status,
                            'date_joined' => $dateJoined,
                            'probation_end_date' => $probationEndDate
                    ];
                    echo view('App\Modules\Employees\Views\Components\employee_form', ['employee' => $employeeData]);
                    ?>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

            if (confirmDeleteBtn) {
                confirmDeleteBtn.addEventListener('click', function () {
                    const employeeId = <?= $employeeId ?>;
                    sendAjaxRequest('<?= base_url('employee/delete') ?>/' + employeeId, {
                        method: 'POST',
                        headers: {
                            '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
                        }
                    }, confirmDeleteBtn, 'Deleting...');
                });
            }

            const confirmRestoreBtn = document.getElementById('confirmRestoreBtn');

            if (confirmRestoreBtn) {
                confirmRestoreBtn.addEventListener('click', function () {
                    const employeeId = <?= $employeeId ?>;
                    sendAjaxRequest('<?= base_url('employee/restore') ?>/' + employeeId, {
                        method: 'POST',
                        headers: {
                            '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
                        }
                    }, confirmRestoreBtn, 'Restoring...');
                });
            }
        });
    </script>

<?= $this->endSection() ?>