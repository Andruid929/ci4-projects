<?= $this->extend("layouts/main") ?>

<?= $this->section("content") ?>

<?php

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
                        <p><strong>Gender:</strong> <?= $gender ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Job Title:</strong> <?= $jobTitle ?></p>
                        <p><strong>Department:</strong> <span class="badge bg-info"><?= $department ?></span></p>
                        <p><strong>Employment Type:</strong> <?= ucfirst($employmentType) ?></p>
                        <p><strong>Status:</strong> <span
                                    class="badge <?= StatusColourHelper::getStatusColour($status) ?>"><?= ucfirst($status) ?></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                    <i class="bi bi-pencil"></i> Edit Employee
                </button>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="bi bi-trash"></i> Delete Employee
                </button>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete employee <strong><?= esc($firstName . ' ' . $lastName) ?></strong>
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
                    const originalContent = confirmDeleteBtn.innerHTML;

                    confirmDeleteBtn.disabled = true;
                    confirmDeleteBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting...';

                    fetch('<?= base_url('employee/delete') ?>/' + employeeId, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            '<?= csrf_header() ?>': '<?= csrf_hash() ?>'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                if (data.redirect) {
                                    window.location.href = data.redirect;
                                }
                            } else {
                                alert(data.message || 'An error occurred while deleting.');
                                confirmDeleteBtn.disabled = false;
                                confirmDeleteBtn.innerHTML = originalContent;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An unexpected error occurred. Please try again.');
                            confirmDeleteBtn.disabled = false;
                            confirmDeleteBtn.innerHTML = originalContent;
                        });
                });
            }
        });
    </script>

<?= $this->endSection() ?>