<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentModel extends Model
{
    protected $table = "equipment";
    protected $primaryKey = "id";
    protected $allowedFields = ['name', 'stock', 'id_category'];
    protected $validationRules = [
        'name' => 'required',
        'stock' => 'required|integer',
        'id_category' => 'required|integer',
    ];
    public function getAllWithCategory()
    {
        return $this->select('equipment.*, equipment_categories.name as category_name')
            ->join('equipment_categories', 'equipment_categories.id = equipment.id_category')
            ->findAll();
    }

    public function getOneWithCategory($id)
    {
        return $this->select('equipment.*, equipment_categories.name as category_name')
            ->join('equipment_categories', 'equipment_categories.id = equipment.id_category')
            ->where('equipment.id', $id)
            ->first();
    }


}