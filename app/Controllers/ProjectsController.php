<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\ProjectsModel;

//use function PHPUnit\Framework\returnArgument;

class ProjectsController extends ResourceController
{
    //protected $modelName = "App\Models\proyectsModel";

    protected $modelName = ProjectsModel::class;

    protected $format = "json";
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        /* $proyect = $this->model->findAll();
        return $this->respond($proyect); */
        return $this->respond($this->model->getAllWithClient());
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
        $proyect = $this->model->getOneWithClient($id);

        if ($proyect) {
            return $this->respond($proyect);
        }
        return $this->failNotFound("Proyecto no encontrado");
    }



    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $data = $this->request->getJSON(true);

        $id = $this->model->insert($data, true);

        if ($id) {
            
            $row = $this->model->getOneWithClient($id);
            return $this->respondCreated($row, 'Proyecto creado.');
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
        $proyect = $this->model->find($id);
        if (!$proyect) {
            return $this->failNotFound('Proyecto no encontrado');
        }
        $data = $this->request->getJSON(true);
        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Proyecto actualizado.');
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
        $proyect = $this->model->find($id);
        if ($proyect) {
            $this->model->delete($id);
            return $this->respondDeleted($proyect, 'Proyecto elimindo.');
        }
        return $this->failNotFound('Proyecto no encontrado.');
    }
}
