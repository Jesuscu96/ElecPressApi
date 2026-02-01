<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipmentCategoriesModel extends Model
{
    protected $table = 'equipment_categories';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name'];

    protected $validationRules = [
        'name' => 'required',
    ];
}
