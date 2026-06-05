<?php

namespace App\Core\Controllers;

use App\Controllers\BaseController;
use App\Core\Services\CoreService;
use App\Helpers\RolesHelper;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class CoreRequestController extends BaseController
{

    private CoreService $service;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger): void
    {
        parent::initController($request, $response, $logger);
        $this->service = $this->getService();
    }

    public function view(int $id): ResponseInterface
    {
        $data = $this->service->getRequestById($id);

        if ($data) {
            log_message('info', 'Request viewed: ' . $id . ' by user ' . auth()->user()->employee_id);

            return $this->response->setJSON([
                "success" => true,
                "data" => $data
            ])->setStatusCode(200);

        } else {
            log_message('error', 'Failed to view request: ' . $id . ' - Not found');

            return $this->response->setJSON([
                "success" => false,
                "message" => "Request not found"
            ])->setStatusCode(404);
        }
    }

    public function edit(int $id): ResponseInterface
    {
        if (!$this->service->getRequestById($id)) {
            log_message('error', 'Failed to edit request: ' . $id . ' - Not found');

            return $this->respondWithNotFound();
        }

        if (!$this->validateInfo()) {
            log_message('error', 'Failed to edit request: ' . $id . ' - Validation errors');

            return $this->respondWithValidationErrors();
        }

        $infoToUpdate = $this->request->getPost();

        $result = $this->service->editRequest($id, $infoToUpdate);

        if ($result) {
            log_message('info', 'Request edited successfully: ' . $id . ' by user ' . auth()->user()->employee_id);

            return $this->response->setJSON([
                "success" => true,
                "message" => "Request edited successfully"
            ])->setStatusCode(200);

        } else {
            log_message('error', 'Failed to edit request: ' . $id);

            return $this->response->setJSON([
                "success" => false,
                "message" => "Failed to edit request, try again"
            ])->setStatusCode(500);
        }
    }

    public function handle(int $id): ResponseInterface
    {
        if (!$this->service->getRequestById($id)) {
            log_message('error', 'Failed to handle request: ' . $id . ' - Not found');

            return $this->respondWithNotFound();
        }

        $rules = [
            "status" => "required|in_list[approved,denied]",
            "approver_comment" => "required"
        ];
        $messages = [
            "status" => "Status is required",
            "approver_comment" => "Comment is required"
        ];

        if (!$this->validate($rules, $messages)) {
            log_message('error', 'Failed to handle request: ' . $id . ' - Validation errors');

            return $this->respondWithValidationErrors();
        }

        $status = $this->request->getPost('status');
        $comment = $this->request->getPost('approver_comment');

        if (!in_array($status, ['approved', 'denied'])) {
            log_message('error', 'Failed to handle request: ' . $id . ' - Invalid status: ' . $status);

            return $this->response->setJSON([
                "success" => false,
                "message" => "Invalid status"
            ])->setStatusCode(400);
        }

        $result = $this->service->updateRequestStatus($id, $status, $comment);

        if ($result) {
            log_message('info', 'Request ' . $status . ' successfully: ' . $id . ' by user ' . auth()->user()->employee_id);

            return $this->response->setJSON([
                "success" => true,
                "message" => "Request has been " . $status
            ])->setStatusCode(200);
        }

        log_message('error', 'Failed to update request status: ' . $id);

        return $this->response->setJSON([
            "success" => false,
            "message" => "Failed to update request status"
        ])->setStatusCode(500);
    }

    public function create(): ResponseInterface
    {
        if (!$this->validateInfo()) {
            log_message('error', 'Failed to create request - Validation errors');

            return $this->respondWithValidationErrors();
        }

        $currentEmployeeId = auth()->user()->employee_id;

        $infoToInsert = $this->request->getPost();
        $infoToInsert['employee_id'] = $currentEmployeeId;
        $infoToInsert['status'] = 'pending';

        $result = $this->service->createRequest($infoToInsert);

        if ($result) {
            log_message('info', 'Request created successfully by user ' . $currentEmployeeId);

            return $this->response->setJSON([
                "success" => true,
                "message" => "Request created successfully"
            ])->setStatusCode(201);

        } else {
            log_message('error', 'Failed to create request by user ' . auth()->user()->employee_id . ' - Database error');

            return $this->response->setJSON([
                "success" => false,
                "message" => "Failed to create request, try again"
            ])->setStatusCode(500);
        }
    }

    public function delete(int $id): ResponseInterface
    {
        $request = $this->service->getRequestById($id);
        if (!$request) {
            log_message('error', 'Failed to delete request: ' . $id . ' - Not found');

            return $this->respondWithNotFound();
        }

        $user = auth()->user();

        if (!$user->inGroup(RolesHelper::ADMIN)) { //These checks don't apply to admins

            if ($request['employee_id'] !== $user->employee_id) {
                log_message('error', 'Failed to delete request: ' . $id . ' - Unauthorized access by user ' . $user->employee_id);

                return $this->response->setJSON([
                    "success" => false,
                    "message" => "You are not authorized to delete this request"
                ])->setStatusCode(403);
            }

            if ($request['status'] !== 'pending') {
                log_message('error', 'Failed to delete request: ' . $id . ' - Request not in pending status');

                return $this->response->setJSON([
                    "success" => false,
                    "message" => "Only pending requests can be deleted"
                ])->setStatusCode(400);
            }

        }
        $result = $this->service->deleteRequest($id);

        if ($result) {
            log_message('info', 'Request deleted successfully: ' . $id . ' by user ' . $user->employee_id);

            return $this->response->setJSON([
                "success" => true,
                "message" => "Request deleted successfully"
            ])->setStatusCode(200);

        } else {
            log_message('error', 'Failed to delete request: ' . $id . ' - Database error');

            return $this->response->setJSON([
                "success" => false,
                "message" => "Failed to delete request, try again"
            ])->setStatusCode(500);
        }
    }

    public function restore(int $id): ResponseInterface
    {
        $user = auth()->user();

        if (!$user->inGroup(RolesHelper::ADMIN)) {
            log_message('error', 'Failed to restore request: ' . $id . ' - Unauthorized access by user ' . $user->employee_id);

            return $this->response->setJSON([
                "success" => false,
                "message" => "You are not authorized to restore requests"
            ])->setStatusCode(403);
        }

        $request = $this->service->getRequestByIdIncludingDeleted($id);

        if (!$request) {
            log_message('error', 'Failed to restore request: ' . $id . ' - Not found');

            return $this->respondWithNotFound();
        }

        if (!isset($request['deleted_at'])) {
            log_message('error', 'Failed to restore request: ' . $id . ' - Request is not deleted');

            return $this->response->setJSON([
                "success" => false,
                "message" => "This request is not deleted and cannot be restored"
            ])->setStatusCode(400);
        }

        $result = $this->service->restoreRequest($id);

        if ($result) {
            log_message('info', 'Request restored successfully: ' . $id . ' by user ' . $user->employee_id);

            return $this->response->setJSON([
                "success" => true,
                "message" => "Request restored successfully"
            ])->setStatusCode(200);
            
        } else {
            log_message('error', 'Failed to restore request: ' . $id . ' - Database error');

            return $this->response->setJSON([
                "success" => false,
                "message" => "Failed to restore request, try again"
            ])->setStatusCode(500);
        }
    }

    protected function respondWithValidationErrors(): ResponseInterface
    {
        log_message('error', 'Validation failed: ' . implode(", ", $this->validator->getErrors()) . ' for user ' . auth()->user()->employee_id);

        return $this->response->setJSON([
            "success" => false,
            "message" => implode(", ", $this->validator->getErrors())
        ])->setStatusCode(400);
    }

    protected function respondWithNotFound(): ResponseInterface
    {
        return $this->response->setJSON([
            "success" => false,
            "message" => "Request not found"
        ])->setStatusCode(404);
    }

    protected final function validateInfo(): bool
    {
        return $this->validate($this->validationRules(), $this->validationErrorMessages());
    }

    protected abstract function validationRules(): array;

    protected abstract function validationErrorMessages(): array;

    protected abstract function getService(): CoreService;
}
