<?php

namespace App\Models;

use CodeIgniter\Model;

class MaterialCategoriesModel extends Model
{
    protected $table = "material_categories";
    protected $primaryKey = "id";
    protected $allowedFields = ['name'];
    protected array $casts = [
        'id'        => 'integer',
    ];
    protected $validationRules = [
        'name' => 'required', 
    ];

    
}