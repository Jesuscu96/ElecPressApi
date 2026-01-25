<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ClientsModels;

//use function PHPUnit\Framework\returnArgument;

class ClientsController extends ResourceController
{
    //protected $modelName = "App\Models\ClientsModel";

    protected $modelName = ClientsModels::class;

    protected $format = "json";
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        /* $client = $this->model->findAll();
        return $this->respond($client); */
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
        $client = $this->model->find($id);

        if($client) {
            return $this->respond($client);
        }
        return $this->failNotFound("Cliente no encontrado");
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
            return $this->respondCreated($data, 'Cliente creado.');
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
        $client = $this->model->find($id);
        if(!$client) {
            return $this->failNotFound('Cliente no encontrado');
        }
        $data = $this->request->getJSON(true);
        if($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Cliente actualizado.');
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
        $client = $this->model->find($id);
        if($client) {
            $this->model->delete($id);
            return $this->respondDeleted($client, 'Cliente elimindo.');
        }
        return $this->failNotFound('Cliente no encontrado.');

    }
}
