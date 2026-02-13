<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\MaterialModel;

//use function PHPUnit\Framework\returnArgument;

class MaterialController extends ResourceController
{
    //protected $modelName = "App\Models\materialsModel";

    protected $modelName = MaterialModel::class;

    protected $format = "json";
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        /* $material = $this->model->findAll();
        return $this->respond($material); */
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
        $material = $this->model->getOneWithCategory($id);

        if ($material) {
            return $this->respond($material);
        }
        return $this->failNotFound("Material no encontrado");
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
            return $this->respondCreated($data, 'Material creado.');
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
        $material = $this->model->find($id);
        if (!$material) {
            return $this->failNotFound('Material no encontrado');
        }
        $data = $this->request->getJSON(true);
        if ($this->model->update($id, $data)) {
            return $this->respondUpdated($data, 'Material actualizado.');
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
        $material = $this->model->find($id);
        if ($material) {
            $this->model->delete($id);
            return $this->respondDeleted($material, 'Material elimindo.');
        }
        return $this->failNotFound('Material no encontrado.');

    }
}
