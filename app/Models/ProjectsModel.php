<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectsModel extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name', 'budget', 'status', 'id_client'];

    protected $validationRules = [
        'name' => 'required',
        'budget' => 'permit_empty|numeric',
        'status' => 'permit_empty|in_list[pending,development,completed,cancelled]',
        'id_client' => 'permit_empty|integer',
    ];

    public function getAllWithClient()
    {
        return $this->select("projects.*, CONCAT(clients.first_name,' ',clients.last_name) as client_name")
            ->join('clients', 'clients.id = projects.id_client', 'left')
            ->findAll();
    }

    public function getOneWithClient($id)
    {
        return $this->select("projects.*, CONCAT(clients.first_name,' ',clients.last_name) as client_name")
            ->join('clients', 'clients.id = projects.id_client', 'left')
            ->where('projects.id', $id)
            ->first();
    }
}
