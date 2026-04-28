<?php

namespace App\Modules\Tasks\Controllers;

use App\Core\Controllers\CoreController;
use App\Modules\Projects\Models\ProjectModel;
use App\Modules\Tasks\Models\TaskModel;
use App\Core\Helpers\FormOptionsHelper;

class TaskController extends CoreController
{

    public function index()
    {
        return view("App\Modules\Tasks\Views\\tasks");
    }

    public function openTask(int $taskId)
    {

        $taskModel = $this->getModel();

        $task = $taskModel->getByNum($taskId);

        if (!$task) {
            return parent::redirectWithErrors("tasks", ["Task under ID $taskId not found"]);
        }

        $data = [
            "taskTitle" => $task["title"],
            "taskNotes" => $task["notes"],
            "taskStatus" => $task["status"],
            "taskProjectCode" => $task["project_code"],
            "taskDueDate" => $task["due_date"],
            "taskPriority" => $task["priority"],
            "taskId" => $taskId
        ];

        return parent::navigateToPage($data);
    }

    public function createTask()
    {

        if (!parent::isFormInfoValid()) {
            return parent::redirectWithErrors("tasks", parent::getErrors());
        }

        $status = $this->request->getPost("status");
        $priority = $this->request->getPost("priority");

        if (FormOptionsHelper::isInvalidStatus($status)) {
            return parent::redirectWithErrors("projects", ["\"$status\" is not a valid status"]);
        }
        
        if (FormOptionsHelper::isInvalidPriority($priority)) {
            return parent::redirectWithErrors("projects", ["\"$priority\" is not a valid priority"]);
        }

        $taskProjectCode = $this->request->getPost("project_code");

        $projectModel = new ProjectModel();
        $project = $projectModel->getByNum($taskProjectCode);

        // TODO: This check should be moved to validation rules, but for now it is here to prevent creating tasks with invalid project codes

        if (!$project) {
            return parent::redirectWithErrors("tasks", ["Invalid project code: $taskProjectCode"]);
        }

        $taskData = [
            "title" => $this->request->getPost("title"),
            "notes" => $this->request->getPost("notes"),
            "status" => $status,
            "due_date" => $this->request->getPost("due_date"),
            "priority" => $priority,
            "project_code" => $taskProjectCode
        ];

        parent::create($taskData);

        return parent::redirectWithSuccess(["Task created successfully."], "tasks");
    }

    protected function getViewName(): string
    {
        return "App\Modules\Tasks\Views\\task";
    }

    protected function getValidationRules(): array
    {
        return [
            "title" => "required",
            "due_date" => "required|valid_date",
            "project_code" => "required|integer"
        ];
    }

    protected function getErrorMessages(): array
    {
        return [
            "title" => [
                "required" => "A valid title is required"
            ],
            "due_date" => [
                "required" => "Date is required",
                "valid_date" => "Date is invalid"
            ],
            "project_code" => [
                "required" => "Task must be connected to a project",
                "integer" => "Project code must be a number"
            ]
        ];
    }

    protected function getModel(): TaskModel
    {
        return new TaskModel();
    }
}