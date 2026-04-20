<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>

<body>
    <div class="container">
        <?php
        use App\Core\Helpers\HtmlHelper;
        use App\Core\Helpers\JsScriptHelper;
        use App\Core\Helpers\QueryListHelper;

        HtmlHelper::renderHeader("Projects", "Manage your projects");

        HtmlHelper::renderAlertErrorDiv();
        HtmlHelper::renderAlertSuccessDiv();

        HtmlHelper::renderAddNewBtn("New project");
        ?>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Start date</th>
                </tr>
            </thead>

            <tbody>

                <?php

                $projects = QueryListHelper::queryList("Project");

                if (empty($projects)):
                    HtmlHelper::renderEmpty("project");

                else:
                    foreach ($projects as $project): ?>

                        <tr>
                            <td>
                                <a href="<?= base_url("project/" . $project["project_code"]) ?>">
                                    <?= $project["title"] ?>
                                </a>
                            </td>

                            <td>
                                <?= $project["status"] ?>
                            </td>

                            <td class="text-muted">
                                <?= $project["start_date"] ?>
                            </td>
                        </tr>
                    </tbody>

                <?php endforeach; endif; ?>
        </table>
    </div>

    <dialog id="projectModal" class="modal">

        <div class="modal-content">
            <div class="modal-header">

                <h2>Create New Project</h2>

                <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
            </div>

            <form id="projectForm" method="POST" action="<?= base_url('projects/create') ?>">

                <div class="form-group">
                    <label for="title">Project Title <span style="color: red;">*</span></label>
                    <input type="text" id="title" name="title" required placeholder="Enter project title">
                </div>

                <div class="form-group">
                    <label for="status">Status <span style="color: red;">*</span></label>

                    <select id="status" name="status" required>
                        <option value="">-- Select status --</option>
                        <option value="open" <?= set_select('status', 'open') ?>>Open</option>
                        <option value="in_progress" <?= set_select('status', 'in_progress') ?>>In Progress</option>
                        <option value="closed" <?= set_select('status', 'closed') ?>>Completed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date <span style="color: red;">*</span></label>

                    <input type="date" id="start_date" name="start_date" value="<?= set_value('start_date') ?>"
                        required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Enter project description"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Project</button>
                </div>

            </form>
        </div>
    </dialog>

    <?php
    JsScriptHelper::functionalModal("projectModal", "projectForm");
    ?>

</body>

</html>