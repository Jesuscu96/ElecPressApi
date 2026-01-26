<?php

namespace App\Models;

use CodeIgniter\Model;

class AssignedEquipmentModel extends Model
{
    protected $table = 'assigned_equipment';
    protected $allowedFields = ['user_id', 'equipment_id'];

    public function getAllExpanded()
    {
        return $this->select("
                assigned_equipment.id,
                assigned_equipment.user_id,
                CONCAT(users.first_name,' ',users.last_name) AS user_name,
                assigned_equipment.equipment_id,
                equipment.name AS equipment_name,
                equipment.stock,
                equipment.id_category,
                equipment_categories.name AS category_name
            ")
            ->join('users', 'users.id = assigned_equipment.user_id')
            ->join('equipment', 'equipment.id = assigned_equipment.equipment_id')
            ->join('equipment_categories', 'equipment_categories.id = equipment.id_category')
            ->findAll();
    }
    public function getOneExpanded($id)
    {
        return $this->select("
            assigned_equipment.id,
            assigned_equipment.user_id,
            CONCAT(users.first_name,' ',users.last_name) AS user_name,
            assigned_equipment.equipment_id,
            equipment.name AS equipment_name,
            equipment.stock,
            equipment.id_category,
            equipment_categories.name AS category_name
        ")
            ->join('users', 'users.id = assigned_equipment.user_id')
            ->join('equipment', 'equipment.id = assigned_equipment.equipment_id')
            ->join('equipment_categories', 'equipment_categories.id = equipment.id_category')
            ->where('assigned_equipment.id', $id)
            ->first();
    }

}


