<?php

namespace App\Models;

use CodeIgniter\Model;

class ProjectsModel extends Model
{
    protected $table = "projects";
    protected $primaryKey = "id";
    protected $allowedFields = ['name', 'created_at', 'budget'];
    protected $validationRules = [
        'name' => 'required', 
        'created_at' => 'required', 
        'budget'  => 'required|numeric',  
    ];

    
}