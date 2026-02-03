<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialModel extends Model
{
    protected $table = "materials";
    protected $primaryKey = "id";
    protected $allowedFields = ['name', 'id_category_material', 'price', 'image'];
    protected $validationRules = [
        'name' => 'required',
        'category_id_material' => 'required|integer',
        'price' => 'required|numeric',
        'image' => 'permit_empty',
        
    ];

    public function getAllWithCategory()
    {
        return $this->select('materials.*, material_categories.name as category_name')
            ->join('material_categories', 'material_categories.id = materials.id_category_material', 'left')
            ->findAll();
    }

    public function getOneWithCategory($id)
    {
        return $this->select('materials.*, material_categories.name as category_name')
            ->join('material_categories', 'material_categories.id = materials.id_category_material', 'left')
            ->where('materials.id', $id)
            ->first();
    }


}