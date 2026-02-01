<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProjectEquipmentModel;

//use function PHPUnit\Framework\returnArgument;

class ProjectEquipmentController extends ResourceController
{
    //protected $modelName = "App\Models\A_equipment$A_equipmentsModel";

    protected $modelName = ProjectEquipmentModel::class;

    protected $format = "json";
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        /* $A_equipment = $this->model->findAll();
        return $this->respond($A_equipment); */
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
        return $this->failNotFound("Equipamiento asignado no encontrado");
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
            return $this->respondCreated($data, 'Equipamiento asignado creado.');
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
        $A_equipment = $this->model->find($id);
        if (!$A_equipment) {
            return $this->failNotFound('Equipamiento asignado no encontrado');
        }
        $data = $this->request->getJSON(true);
        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Equipamiento asignado actualizado.');
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
        $A_equipment = $this->model->find($id);
        if ($A_equipment) {
            $this->model->delete($id);
            return $this->respondDeleted($A_equipment, 'Equipamiento asignado elimindo.');
        }
        return $this->failNotFound('Equipamiento asignado no encontrado.');

    }
}
