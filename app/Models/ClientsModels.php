<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientsModels extends Model
{
    protected $table = "clients";
    protected $primaryKey = "id";
    protected $allowedFields = ['first_name', 'last_name', 'company', 'phone', 'email'];
    protected $validationRules = [
        'first_name' => 'required', 
        'last_name' => 'required',
        'company'    => 'permit_empty',  
        'phone'  => 'required', 
        'email' => 'required|valid_email',
    ];

    
}