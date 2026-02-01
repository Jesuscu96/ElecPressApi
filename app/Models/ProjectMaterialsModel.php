<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectMaterialsModel extends Model
{
    protected $table = 'project_materials';
    protected $primaryKey = 'id';

    protected $allowedFields = ['project_id', 'material_id', 'quantity'];

    protected $validationRules = [
        'project_id'  => 'required|integer',
        'material_id' => 'required|integer',
        'quantity'    => 'required|numeric',
    ];

    public function getAllExpanded()
    {
        return $this->select("
                project_materials.id,
                project_materials.project_id,
                projects.name as project_name,
                project_materials.material_id,
                materials.name as material_name,
                project_materials.quantity
            ")
            ->join('projects', 'projects.id = project_materials.project_id', 'left')
            ->join('materials', 'materials.id = project_materials.material_id', 'left')
            ->findAll();
    }

    public function getOneExpanded($id)
    {
        return $this->select("
                project_materials.id,
                project_materials.project_id,
                projects.name as project_name,
                project_materials.material_id,
                materials.name as material_name,
                project_materials.quantity
            ")
            ->join('projects', 'projects.id = project_materials.project_id', 'left')
            ->join('materials', 'materials.id = project_materials.material_id', 'left')
            ->where('project_materials.id', $id)
            ->first();
    }
}
