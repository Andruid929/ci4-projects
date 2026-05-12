<?php

use App\Modules\Employees\Helpers\TableBodyHelper;

?>
<?= $this->extend("layouts/main") ?>

<?= $this->section("content") ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Employees</h5>

                    <?php if ($isRegularDashboard): ?>

                        <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal"
                            data-bs-target="#addModal">
                            <i class="bi bi-plus-circle"></i> Add Employee
                        </button>

                    <?php endif ?>
                </div>

                <div class="table-responsive">

                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Department</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            
                            if ($isRegularDashboard) {
                                TableBodyHelper::renderTableBody($employees, "employee/");

                            } else {
                                TableBodyHelper::renderTableBody($employees, "employee/deleted/");
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <?php if (count($employees) !== 0): ?>
                <div class="card-footer bg-light">
                    <small class="text-muted">Click on any row to view employee details</small>
                </div>
                <?php endif; ?>
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