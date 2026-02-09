<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProjectMaterialsModel;

//use function PHPUnit\Framework\returnArgument;

class ProjectMaterialsController extends ResourceController
{
    //protected $modelName = "App\Models\A_projectsModel";

    protected $modelName = ProjectMaterialsModel::class;

    protected $format = "json";
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {

        $projectId = $this->request->getGet('project_id');

        if ($projectId) {
            return $this->respond(
                $this->model->where('project_id', (int)$projectId)->findAll()
            );
        }

        return $this->respond($this->model->findAll());
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $row = $this->model->getOneExpanded($id);

        if ($row) {
            return $this->respond($row);
        }
        return $this->failNotFound("Material asignado no encontrado");
    }



    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $data = $this->request->getJSON(true);

        if ($this->model->insert($data)) {
            return $this->respondCreated($data, 'Material asignado creado.');
        }

        return $this->failValidationErrors($this->model->errors());
    }


    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $A_material = $this->model->find($id);
        if (!$A_material) {
            return $this->failNotFound('Material asignado no encontrado');
        }
        $data = $this->request->getJSON(true);
        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Material asignado actualizado.');
        }
        return $this->failValidationErrors($this->model->errors());
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $A_material = $this->model->find($id);
        if ($A_material) {
            $this->model->delete($id);
            return $this->respondDeleted($A_material, 'Material asignado elimindo.');
        }
        return $this->failNotFound('Material asignado no encontrado.');
    }
}
