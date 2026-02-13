<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectMaterialsModel extends Model
{
    protected $table = 'project_materials';
    protected $primaryKey = 'id';

    protected $allowedFields = ['project_id', 'material_id', 'quantity'];
    protected array $casts = [
        'id' => 'integer',
        'project_id' => 'integer',
        'material_id' => 'integer',
        'quantity' => 'numeric',
    ];

    protected $validationRules = [
        'project_id' => 'required|integer',
        'material_id' => 'required|integer',
        'quantity' => 'required|float',
    ];

    public function getAllExpanded($idProject = null)
    {
        $builder = $this->select("
            project_materials.id,
            project_materials.project_id,
            projects.name as project_name,
            project_materials.material_id,
            materials.name as material_name,
            materials.image as material_image,
            project_materials.quantity as material_quantity,
            materials.id_category_material  as material_id_category
        ")
            ->join('projects', 'projects.id = project_materials.project_id', 'left')
            ->join('materials', 'materials.id = project_materials.material_id', 'left');

        if ($idProject !== null) {
            $builder->where('project_materials.project_id', (int) $idProject);
        }

        return $builder->findAll();
    }

    // public function getAllExpandedByProject($projectId)
    // {
    //     return $this->select("
    //         project_materials.id,
    //         project_materials.project_id,
    //         projects.name as project_name,
    //         project_materials.material_id,
    //         materials.name as material_name,
    //         materials.image as material_image,

    //         project_materials.quantity
    //     ")
    //         ->join('projects', 'projects.id = project_materials.project_id', 'left')
    //         ->join('materials', 'materials.id = project_materials.material_id', 'left')
    //         ->where('project_materials.project_id', $projectId)
    //         ->findAll();
    // }


    public function getOneExpanded($id)
    {
        return $this->select("
                project_materials.id,
                project_materials.project_id,
                projects.name as project_name,
                project_materials.material_id,
                materials.name as material_name,
                materials.image as material_image,
                project_materials.quantity,
                materials.id_category_material  as material_id_category
            ")
            ->join('projects', 'projects.id = project_materials.project_id', 'left')
            ->join('materials', 'materials.id = project_materials.material_id', 'left')
            ->where('project_materials.id', $id)
            ->first();
    }
}
