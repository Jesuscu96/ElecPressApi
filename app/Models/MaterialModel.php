<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
    protected $table = "materials";
    protected $primaryKey = "id";
    protected $allowedFields = ['name', 'category_id_material', 'stock', 'price'];
    protected $validationRules = [
        'name' => 'required',
        'category_id_material' => 'required|integer',
        'stock' => 'required|integer',
        'price' => 'required|numeric',
    ];

    public function getAllWithCategory()
    {
        return $this->select('materials.*, material_categories.name as category_name')
            ->join('material_categories', 'material_categories.id = materials.category_id_material')
            ->findAll();
    }


}