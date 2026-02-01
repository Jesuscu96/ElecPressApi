<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentModel extends Model
{
    protected $table = "equipment";
    protected $primaryKey = "id";
    protected $allowedFields = ['name', , 'id_category_equipment'];
    protected $validationRules = [
        'name' => 'required',
        'id_category_equipment' => 'permit_empty|integer',
    ];
    public function getAllWithCategory()
    {
        return $this->select('equipment.*, equipment_categories.name as category_name')
            ->join('equipment_categories', 'equipment_categories.id = equipment.id_category_equipment', 'left')
            ->findAll();
    }

    public function getOneWithCategory($id)
    {
        return $this->select('equipment.*, equipment_categories.name as category_name')
            ->join('equipment_categories', 'equipment_categories.id = equipment.id_category_equipment', 'left')
            ->where('equipment.id', $id)
            ->first();
    }


}