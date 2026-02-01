<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $allowedFields = ['role', 'first_name', 'last_name', 'password', 'email', 'birth_date', 'image', 'phone'];
    protected $validationRules = [
        'role'  => 'required|in_list[superAdmin,admin,user,inactive]',
        'first_name' => 'required', 
        'last_name' => 'required', 
        'password'  => 'required|min_length[6]', 
        'email'  => 'required|valid_email', 
        'birth_date'  => 'required', 
        'image' => 'permit_empty',
        'phone'  => 'required', 
    ];

    
}