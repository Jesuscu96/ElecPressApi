<?php

namespace App\Models;

use CodeIgniter\Model;

class AssignedProjectsModel extends Model
{
    protected $table = 'assigned_projects';
    protected $allowedFields = ['user_id', 'client_id', 'project_id'];

    public function getAllExpanded()
    {
        return $this->select("
                assigned_projects.id,
                assigned_projects.user_id,
                CONCAT(users.first_name,' ',users.last_name) as user_name,
                assigned_projects.client_id,
                CONCAT(clients.first_name,' ',clients.last_name) as client_name,
                assigned_projects.project_id,
                projects.name as project_name
            ")
            ->join('users', 'users.id = assigned_projects.user_id')
            ->join('clients', 'clients.id = assigned_projects.client_id')
            ->join('projects', 'projects.id = assigned_projects.project_id')
            ->findAll();
    }
    public function getOneExpanded($id)
    {
        return $this->select("
            assigned_projects.id,
            assigned_projects.user_id,
            CONCAT(users.first_name,' ',users.last_name) AS user_name,
            assigned_projects.client_id,
            CONCAT(clients.first_name,' ',clients.last_name) AS client_name,
            clients.company AS client_company,
            assigned_projects.project_id,
            projects.name AS project_name
        ")
            ->join('users', 'users.id = assigned_projects.user_id')
            ->join('clients', 'clients.id = assigned_projects.client_id')
            ->join('projects', 'projects.id = assigned_projects.project_id')
            ->where('assigned_projects.id', $id)
            ->first();
    }

}
