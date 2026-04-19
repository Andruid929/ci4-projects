<?php

namespace App\Modules\Projects\Controllers;

use App\Core\Common\Status;
use App\Core\Controllers\CoreController;
use App\Modules\Projects\Models\ProjectModel;
use App\Core\Helpers\FormOptionsHelper;

class Project extends CoreController
{

    public function index()
    {
        return view("projects");
    }

    public function openProject(int $projectCode)
    {

        $projectModel = $this->getModel();

        $project = $projectModel->getByNum($projectCode);

        if (!$project) {
            return parent::redirectWithErrors("projects", ["Project under code $projectCode not found"]);
        }

        $data = [
            "projectTitle" => $project["title"],
            "projectDescription" => $project["description"],
            "projectStartDate" => $project["start_date"],
            "projectStatus" => $project["status"],
            "projectCode" => $projectCode
        ];

        return parent::navigateToPage($data);
    }

    public function createProject()
    {

        if (!parent::isFormInfoValid()) {
            return parent::redirectWithErrors("projects", $this->getErrors());
        }

        $status = $this->request->getPost("status");

        if (FormOptionsHelper::isInvalidStatus($status)) {
            return parent::redirectWithErrors("projects", ["\"$status\" is not a valid status"]);
        }

        $projectData = [
            "title" => $this->request->getPost("title"),
            "description" => $this->request->getPost("description"),
            "start_date" => $this->request->getPost("start_date"),
            "status" => $status
        ];

        parent::create($projectData);

        return parent::redirectWithSuccess(["Project created successfully."], "projects");
    }

    protected function getViewName(): string
    {
        return "project";
    }

    protected function getValidationRules(): array
    {
        return [
            "title" => "required",
            "start_date" => "required|valid_date",
        ];
    }

    protected function getErrorMessages(): array
    {
        return [
            "title" => [
                "required" => "Title is required"
            ],
            "start_date" => [
                "required" => "Start date is required",
                "valid_date" => "Date is invalid",
            ]
        ];
    }

    protected function getModel(): ProjectModel
    {
        return new ProjectModel();
    }
}