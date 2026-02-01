<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\EquipmentModel;

//use function PHPUnit\Framework\returnArgument;

class EquipmentController extends ResourceController
{
    //protected $modelName = "App\Models\equipmentsModel";

    protected $modelName = EquipmentModel::class;

    protected $format = "json";
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        /* $equipment = $this->model->findAll();
        return $this->respond($equipment); */
        return $this->respond($this->model->getAllWithCategory());


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
        $row = $this->model->getOneWithCategory($id);

        if($row) {
            return $this->respond($row);
        }
        return $this->failNotFound("Equipamiento no encontrado");
    }



    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $data = $this->request->getJSON(true);

        if($this->model->insert($data)) {
            return $this->respondCreated($data, 'Equipamiento creado.');
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
        $equipment = $this->model->find($id);
        if(!$equipment) {
            return $this->failNotFound('Equipamiento no encontrado');
        }
        $data = $this->request->getJSON(true);
        if($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Equipamiento actualizado.');
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
        $equipment = $this->model->find($id);
        if($equipment) {
            $this->model->delete($id);
            return $this->respondDeleted($equipment, 'Equipamiento elimindo.');
        }
        return $this->failNotFound('Equipamiento no encontrado.');

    }
}
