<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <link rel="stylesheet" href="<?= base_url("/css/style.css") ?>">
</head>

<body>
    <div class="container">

        <?php
        use App\Core\Helpers\HtmlHelper;
        use App\Core\Helpers\JsScriptHelper;
                                    use App\Core\Helpers\QueryListHelper;
                                    use App\Modules\Tasks\Models\TaskModel;

        HtmlHelper::renderHeader('Tasks', 'Manage your tasks');

        HtmlHelper::renderAlertErrorDiv();
        HtmlHelper::renderAlertSuccessDiv();
        ?>

        <div class="flex-between mb-20">
            <div></div>
            <button class="btn btn-primary" onclick="openModal()">+ New Task</button>
        </div>

        <table>
            <thead>

                <tr>
                    <th>Title</th>
                    <th>Priority</th>
                    <th>Due date</th>
                </tr>

            </thead>

            <tbody>

                <?php
                $tasks = QueryListHelper::queryList("Task");

                if (empty($tasks)): ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted">
                            No tasks found. Create a new task to get started.
                        </td>
                    </tr>
                <?php else: ?>

                    <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td>
                                <a href="<?= base_url("task/" . $task["task_id"]) ?>">
                                    <?= $task["title"] ?>
                                </a>
                            </td>
                            <td>
                                <?= $task["priority"] ?>
                            </td>
                            <td>
                                <?= $task["due_date"] ?>
                            </td>
                        </tr>

                    <?php endforeach; endif; ?>
            </tbody>
        </table>

    </div>

    <dialog id="taskModal" class="modal">

        <div class="modal-content">
            <div class="modal-header">

                <h2>Create new task</h2>

                <button type="button" class="modal-close" onclick="closeModal()">&times;</button>
            </div>

            <form id="taskForm" method="POST" action="<?= base_url('tasks/create') ?>">

                <div class="form-group">
                    <label for="title">Task Title <span style="color: red;">*</span></label>
                    <input type="text" id="title" name="title" required placeholder="Enter task title">
                </div>

                <div class="form-group">
                    <label for="project-code">Project code <span style="color: red;">*</span></label>
                    <input type="number" id="project_code" name="project_code" required
                        placeholder="Enter code for this task's project">
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
                    <label for="priority">Priority <span style="color: red;">*</span></label>

                    <select id="priority" name="priority" required>
                        <option value="">-- Select priority --</option>
                        <option value="low" <?= set_select('priority', 'low') ?>>Low</option>
                        <option value="medium" <?= set_select('priority', 'medium') ?>>Medium</option>
                        <option value="high" <?= set_select('priority', 'high') ?>>High</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="due_date">Due Date <span style="color: red;">*</span></label>

                    <input type="date" id="due_date" name="due_date" value="<?= set_value('due_date') ?>" required>
                </div>

                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea id="notes" name="notes" placeholder="Enter task notes"></textarea>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create task</button>
                </div>

            </form>
        </div>
    </dialog>

    <?php
    JsScriptHelper::functionalModal("taskModal", "taskForm");
    ?>
</body>

</html>