<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectEquipmentModel extends Model
{
    protected $table = 'project_equipment';
    protected $primaryKey = 'id';

    protected $allowedFields = ['project_id', 'equipment_id', 'quantity'];
    protected array $casts = [
        'id' => 'integer',
        'equipment_id' => 'integer',
        'quantity' => 'integer',
    ];
    protected $validationRules = [
        'project_id' => 'required|integer',
        'equipment_id' => 'required|integer',
        'quantity' => 'required|integer',
    ];

    public function getAllExpanded()
    {
        return $this->select("
                project_equipment.id,
                project_equipment.project_id,
                projects.name as project_name,
                project_equipment.equipment_id,
                equipment.name as equipment_name,
                equipment.image as equipment_image,
                project_equipment.quantity
            ")
            ->join('projects', 'projects.id = project_equipment.project_id', 'left')
            ->join('equipment', 'equipment.id = project_equipment.equipment_id', 'left')
            ->findAll();
    }
    public function getAllExpandedByProject(int $projectId): array
    {
        return $this->select("
            project_equipment.id,
            project_equipment.equipment_id,
            equipment.name as equipment_name,
            equipment.image as equipment_image,
            project_equipment.quantity
        ")
            ->join('equipment', 'equipment.id = project_equipment.equipment_id', 'left')
            ->where('project_equipment.project_id', $projectId)
            ->findAll();
    }


    public function getOneExpanded($id)
    {
        return $this->select("
                project_equipment.id,
                project_equipment.project_id,
                projects.name as project_name,
                project_equipment.equipment_id,
                equipment.name as equipment_name,
                equipment.image as equipment_image,
                project_equipment.quantity
            ")
            ->join('projects', 'projects.id = project_equipment.project_id', 'left')
            ->join('equipment', 'equipment.id = project_equipment.equipment_id', 'left')
            ->where('project_equipment.id', $id)
            ->first();
    }
}
