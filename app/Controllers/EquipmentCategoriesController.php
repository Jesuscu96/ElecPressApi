<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\EquipmentCategoriesModel;

class EquipmentCategoriesController extends ResourceController
{
    protected $modelName = EquipmentCategoriesModel::class;
    protected $format    = 'json';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $category = $this->model->find($id);

        if ($category) {
            return $this->respond($category);
        }
        return $this->failNotFound("Categoria de equipamiento no encontrado");
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->failValidationErrors(['data' => 'Invalid JSON body']);
        }

        if ($this->model->insert($data)) {
            return $this->respondCreated($data, 'Categoria de equipamiento creado.');
        }

        return $this->failValidationErrors($this->model->errors());
    }

    public function update($id = null)
    {
        $category = $this->model->find($id);
        if (!$category) {
            return $this->failNotFound('Categoria de equipamiento no encontrado');
        }

        $data = $this->request->getJSON(true);
        if (!$data) {
            return $this->failValidationErrors(['data' => 'Invalid JSON body']);
        }

        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Categoria de equipamiento actualizado.');
        }

        return $this->failValidationErrors($this->model->errors());
    }

    public function delete($id = null)
    {
        $category = $this->model->find($id);

        if ($category) {
            $this->model->delete($id);
            return $this->respondDeleted($category, 'Categoria de equipamiento elimindo.');
        }

        return $this->failNotFound('Categoria de equipamiento no encontrado.');
    }
}
