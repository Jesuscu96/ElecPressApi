<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProjectUsersModel;
use App\Models\ProjectsModel;


//use function PHPUnit\Framework\returnArgument;

class ProjectUsersController extends ResourceController
{
    //protected $modelName = "App\Models\A_projectsModel";

    protected $modelName = ProjectUsersModel::class;

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
            return $this->respond($this->model->getAllExpandedByProject($projectId));
        }

        return $this->respond($this->model->getAllExpanded());
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
        return $this->failNotFound("Poryecto asignado no encontrado");
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
            return $this->respondCreated($data, 'Poryecto asignado creado.');
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
        $A_project = $this->model->find($id);
        if (!$A_project) {
            return $this->failNotFound('Poryecto asignado no encontrado');
        }
        $data = $this->request->getJSON(true);
        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Poryecto asignado actualizado.');
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
        $A_project = $this->model->find($id);
        if ($A_project) {
            $this->model->delete($id);
            return $this->respondDeleted($A_project, 'Poryecto asignado elimindo.');
        }
        return $this->failNotFound('Poryecto asignado no encontrado.');
    }
}
