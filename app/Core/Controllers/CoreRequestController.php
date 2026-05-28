<?php

namespace App\Core\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Core\Helper\StatusHelper;
use CodeIgniter\Model;

abstract class CoreRequestController extends BaseController
{
    use ResponseTrait;

    protected $model;

    /**
     * Data mapping for create/update operations.
     * Should be overridden in child classes if field names differ from POST names.
     */
    protected array $fieldMap = [];

    public function create()
    {
        $data = $this->getRequestData();
        $data['employee_id'] = auth()->user()->employee_id;
        $data['status']      = StatusHelper::PENDING;

        if ($this->model->insert($data)) {
            return $this->respondCreated(['message' => 'Request created successfully']);
        }

        return $this->fail($this->model->errors());
    }

    public function view($id)
    {
        $request = $this->model->find($id);
        if (!$request) {
            return $this->failNotFound('Request not found');
        }

        return $this->respond($request);
    }

    public function edit($id)
    {
        $request = $this->model->find($id);
        if (!$request) {
            return $this->failNotFound('Request not found');
        }

        $data = $this->getRequestData(false);

        if ($this->model->update($id, $data)) {
            return $this->respond(['message' => 'Request updated successfully']);
        }

        return $this->fail($this->model->errors());
    }

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            return $this->respondDeleted(['message' => 'Request deleted successfully']);
        }

        return $this->fail('Failed to delete request');
    }

    public function approve($id)
    {
        $data = [
            'status'           => StatusHelper::APPROVED,
            'approver_comment' => $this->request->getPost('approver_comment'),
        ];

        if ($this->model->update($id, $data)) {
            return $this->respond(['message' => 'Request approved']);
        }

        return $this->fail($this->model->errors());
    }

    public function deny($id)
    {
        $data = [
            'status'           => StatusHelper::DENIED,
            'approver_comment' => $this->request->getPost('approver_comment'),
        ];

        if ($this->model->update($id, $data)) {
            return $this->respond(['message' => 'Request denied']);
        }

        return $this->fail($this->model->errors());
    }

    /**
     * Extracts data from request based on fieldMap or allowedFields
     */
    protected function getRequestData(bool $isCreate = true): array
    {
        $data = [];
        $fields = !empty($this->fieldMap) ? $this->fieldMap : $this->model->allowedFields;

        foreach ($fields as $dbField => $postField) {
            if (is_numeric($dbField)) {
                $dbField = $postField;
            }
            
            // Skip system fields that shouldn't be filled from POST directly
            if (in_array($dbField, ['employee_id', 'status', 'approver_comment', 'updated_at', 'created_at', 'deleted_at'])) {
                continue;
            }

            $val = $this->request->getPost($postField);
            if ($val !== null) {
                $data[$dbField] = $val;
            }
        }

        return $data;
    }
}
