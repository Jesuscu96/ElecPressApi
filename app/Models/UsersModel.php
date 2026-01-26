<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $allowedFields = ['role', 'first_name', 'last_name', 'password', 'email', 'birth_date', 'created_at', 'phone'];
    protected $validationRules = [
        'role'  => 'required',
        'first_name' => 'required', 
        'last_name' => 'required', 
        'password'  => 'required|length < 6', 
        'email'  => 'required|valid_email', 
        'birth_date'  => 'required', 
        'created_at'  => 'required', 
        'phone'  => 'required', 
    ];

    
}