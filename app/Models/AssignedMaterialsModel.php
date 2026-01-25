<?php

namespace App\Models;

use CodeIgniter\Model;

class AssignedMaterialsModel extends Model
{
    protected $table = 'assigned_materials';
    protected $allowedFields = ['user_id', 'material_id', 'project_id'];

    public function getAllExpanded()
    {
        return $this->select("
                assigned_materials.id,
                assigned_materials.user_id,
                CONCAT(users.first_name,' ',users.last_name) AS user_name,
                assigned_materials.material_id,
                materials.name AS material_name,
                materials.stock,
                materials.price,
                materials.category_id_material,
                material_categories.name AS category_name,
                assigned_materials.project_id,
                projects.name AS project_name
            ")
            ->join('users', 'users.id = assigned_materials.user_id')
            ->join('materials', 'materials.id = assigned_materials.material_id')
            ->join('material_categories', 'material_categories.id = materials.category_id_material')
            ->join('projects', 'projects.id = assigned_materials.project_id')
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
