<?= $this->extend("layouts/main") ?>

<?= $this->section("content") ?>
    
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Employees</h5>
                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal"
                                data-bs-target="#addModal">
                            <i class="bi bi-plus-circle"></i> Add Employee
                        </button>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                            <tr>
                                <th scope="col" width="10%">ID</th>
                                <th scope="col" width="25%">Name</th>
                                <th scope="col" width="30%">Email</th>
                                <th scope="col" width="25%">Department</th>
                                <th scope="col" width="10%">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            
                            <?php
                            
                            use App\Modules\Employees\Helpers\StatusColourHelper;
                            use App\Modules\Employees\Services\EmployeeService;
                            
                            $employeeService = new EmployeeService();
                            $employees = $employeeService->getAllEmployees();
                            
                            if (count($employees) === 0): ?>
                                <tr>
                                    <td colspan="5" class="text-center">No employees found.</td>
                                </tr>
                            
                            <?php else:
                                foreach ($employees as $employee): ?>
                                    
                                    <tr class="clickable-row"
                                        onclick="window.location='<?= base_url('employee/' . $employee['employee_id']) ?>'">
                                        <td>
                                            <?= $employee['employee_id'] ?>
                                        </td>
                                        <td>
                                            <?= $employee['first_name'] . ' ' . $employee['last_name'] ?>
                                        </td>
                                        <td>
                                            <?= $employee['email'] ?>
                                        </td>
                                        <td><span class="badge bg-info">
                                                <?= $employee['department'] ?>
                                            </span></td>
                                        <td>
                                            <span class="badge <?= StatusColourHelper::getStatusColour($employee['status']) ?>">
                                                <?= $employee['status'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                
                                <?php
                                endforeach;
                            endif;
                            ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card-footer bg-light">
                        <small class="text-muted">Click on any row to view employee details</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <?= view("App\Modules\Employees\Views\Components\\employee_form") ?>
                </div>
            </div>
        </div>
    </div>
    
    <style>
        .clickable-row {
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
        }

        .clickable-row:hover {
            background-color: #f8f9fa;
        }

        .table {
            margin: 0;
        }
    </style>

<?php $this->endSection(); ?>