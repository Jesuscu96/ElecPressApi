<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use App\Models\UsersModel;

class UsersController extends ResourceController
{
    protected $modelName = UsersModel::class;
    protected $format = "json";

    public function index()
    {
        
        $users = $this->model
            ->select('id, role, first_name, last_name, email, birth_date, created_at, image, phone')
            ->findAll();

        return $this->respond($users);
    }

    public function show($id = null)
    {
        
        $user = $this->model
            ->select('id, role, first_name, last_name, email, birth_date, created_at, image, phone')
            ->find($id);

        if ($user) {
            return $this->respond($user);
        }
        return $this->failNotFound("Usuario no encontrado");
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        
        if (!isset($data['password']) || trim($data['password']) === '') {
            return $this->failValidationErrors([
                'password' => 'La contraseña es obligatoria.'
            ]);
        }

        
        $insertId = $this->model->insert($data, true);

        if ($insertId) {
            
            $user = $this->model
                ->select('id, role, first_name, last_name, email, birth_date, created_at, image, phone')
                ->find($insertId);

            return $this->respondCreated($user, 'Usuario creado.');
        }

        return $this->failValidationErrors($this->model->errors());
    }

    public function update($id = null)
    {
        $user = $this->model->find($id);
        if (!$user) {
            return $this->failNotFound('Usuario no encontrado');
        }

        $data = $this->request->getJSON(true);

       
        $data['id'] = (int) $id;

        
        if (isset($data['password']) && trim($data['password']) === '') {
            unset($data['password']);
        }

        if ($this->model->update($id, $data)) {
            
            $updated = $this->model
                ->select('id, role, first_name, last_name, email, birth_date, created_at, image, phone')
                ->find($id);

            return $this->respondUpdated($updated, 'Usuario actualizado.');
        }

        return $this->failValidationErrors($this->model->errors());
    }

    public function delete($id = null)
    {
        $user = $this->model->find($id);
        if ($user) {
            $this->model->delete($id);
            return $this->respondDeleted(['id' => (int)$id], 'Usuario eliminado.');
        }
        return $this->failNotFound('Usuario no encontrado.');
    }
}
