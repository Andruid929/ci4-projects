<?php
/**
 * Employee Form Component
 *
 * @var array|null $employee - Employee data for editing, null for creating
 * @var string $submitButtonText - Text for submit button
 * @var string $submitButtonClass - CSS class for submit button
 */

$isEditing = !empty($employee);

$employeeId = $isEditing ? $employee['employee_id'] : null;

$actionUrl = $isEditing
        ? base_url('employee/update/' . $employeeId)
        : base_url('employee/create');

$formTitle = $isEditing ? 'Edit Employee' : 'Add New Employee';

$submitButtonText = $submitButtonText ?? ($isEditing ? 'Update Employee' : 'Create Employee');

$submitButtonClass = $submitButtonClass ?? 'btn btn-primary';
?>

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title mb-0"><?= $formTitle ?></h5>
    </div>
    <div class="card-body">
        <form id="employeeForm" action="<?= $actionUrl ?>" method="POST">
            <?= csrf_field() ?>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="first_name"
                           value="<?= $isEditing ? esc($employee['first_name']) : '' ?>" placeholder="Enter first name"
                           required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="last_name"
                           value="<?= $isEditing ? esc($employee['last_name']) : '' ?>" placeholder="Enter last name"
                           required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email"
                           value="<?= $isEditing ? esc($employee['email']) : '' ?>" placeholder="Enter email address"
                           required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" name="phone_number"
                           value="<?= $isEditing ? esc($employee['phone_number']) : '' ?>"
                           placeholder="Enter phone number">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Department <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="department"
                           value="<?= $isEditing ? esc($employee['department']) : '' ?>" placeholder="Enter department"
                           required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Job Title <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="job_title"
                           value="<?= $isEditing ? esc($employee['job_title']) : '' ?>" placeholder="Enter job title"
                           required>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Gender</label>
                    <select class="form-select" name="gender">
                        <option value="">Select Gender</option>
                        <option value="m" <?= $isEditing && $employee['gender'] === 'm' ? 'selected' : '' ?>>Male
                        </option>
                        <option value="f" <?= $isEditing && $employee['gender'] === 'f' ? 'selected' : '' ?>>Female
                        </option>
                        <option value="r" <?= $isEditing && $employee['gender'] === 'r' ? 'selected' : '' ?>>Rather not say 
                        </option>
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Employment Type <span class="text-danger">*</span></label>
                    <select class="form-select" name="employment_type" required>
                        <option value="">Select Employment Type</option>
                        <option value="full-time" <?= $isEditing && $employee['employment_type'] === 'full-time' ? 'selected' : '' ?>>
                            Full-time
                        </option>
                        <option value="part-time" <?= $isEditing && $employee['employment_type'] === 'part-time' ? 'selected' : '' ?>>
                            Part-time
                        </option>
                        <option value="contract" <?= $isEditing && $employee['employment_type'] === 'contract' ? 'selected' : '' ?>>
                            Contract
                        </option>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Employee Code</label>
                    <input type="text" class="form-control" name="employee_code"
                           value="<?= $isEditing ? esc($employee['employee_code']) : '' ?>"
                           placeholder="Auto-generated" readonly>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status <span class="text-danger">*</span></label>
                    <select class="form-select" name="status" required>
                        <option value="active" <?= $isEditing && $employee['status'] === 'active' ? 'selected' : '' ?>>
                            Active
                        </option>
                        <option value="inactive" <?= $isEditing && $employee['status'] === 'inactive' ? 'selected' : '' ?>>
                            Inactive
                        </option>
                        <option value="terminated" <?= $isEditing && $employee['status'] === 'terminated' ? 'selected' : '' ?>>
                            Terminated
                        </option>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Date Joined</label>
                    <input type="datetime-local" class="form-control" name="date_joined"
                           value="<?= $isEditing && !empty($employee['date_joined']) ? date('Y-m-d\TH:i', strtotime($employee['date_joined'])) : '' ?>">
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Probation End Date</label>
                    <input type="datetime-local" class="form-control" name="probation_end_date"
                           value="<?= $isEditing && !empty($employee['probation_end_date']) ? date('Y-m-d\TH:i', strtotime($employee['probation_end_date'])) : '' ?>">
                </div>
            </div>
            
            <div class="form-actions pt-3">
                <button type="submit" class="<?= $submitButtonClass ?>">
                    <i class="bi bi-check-circle"></i> <?= $submitButtonText ?>
                </button>
                <button type="button" class="btn btn-secondary ms-2" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('employeeForm');
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalBtnContent = submitBtn.innerHTML;

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';

            const formData = new FormData(form);
            const action = form.getAttribute('action');

            fetch(action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // You could use a toast library here if available
                        alert(data.message);
                        if (data.redirect) {
                            window.location.href = data.redirect;
                        }
                    } else {
                        alert(data.message || 'An error occurred.');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnContent;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An unexpected error occurred. Please try again.');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnContent;
                });
        });
    });
</script>