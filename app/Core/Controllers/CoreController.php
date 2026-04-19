<?php

namespace App\Core\Controllers;

use App\Controllers\BaseController;
use App\Models\CoreModel;

class CoreController extends BaseController
{

    protected function navigateToPage(array $data)
    {
        return view($this->getViewName(), $data);
    }

    protected function create(array $dataToInsert): void
    {
        $model = $this->getModel();

        $model->addNewEntry($dataToInsert);
    }

    protected function getViewName(): string
    {
        return "landing";
    }

    protected function redirectWithErrors(string $to, array $errors)
    {
        return redirect($to)
            ->withInput()
            ->with("errors", $errors);
    }

    protected function redirectWithSuccess(array $messages, string $redirectTo)
    {
        return redirect()->to($redirectTo)
            ->with("success", $messages);
    }

    protected function redirectWithInfo(string $redirectTo, string $key, array $info)
    {
        return redirect()->to($redirectTo)
            ->with($key, $info);
    }

    protected function isFormInfoValid(): bool
    {
        $rules = $this->getValidationRules();

        $errorMessages = $this->getErrorMessages();
        
        if (! $errorMessages) {
            return $this->validate($rules);
        }

        return $this->validate($rules, $errorMessages);
    }

    protected function getValidationRules(): array
    {
        return [];
    }

    protected function getErrorMessages(): array {
        return [];
    }

    protected function getErrors() {
        return $this->validator->getErrors();
    }

    protected function getModel(): CoreModel
    {
        return new CoreModel();
    }
};