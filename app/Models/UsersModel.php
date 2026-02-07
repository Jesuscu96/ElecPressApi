<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    protected $allowedFields = ['role', 'first_name', 'last_name', 'password', 'email', 'birth_date', 'image', 'phone'];
    protected array $casts = [
        'id'        => 'integer',
    ];
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];
    
    protected $validationRules = [
        'role'       => 'required|in_list[superAdmin,admin,user,inactive]',
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => 'required|valid_email|is_unique[users.email,id,{id}]',
        'birth_date' => 'required|valid_date',
        'phone'      => 'required',
        'password'   => 'permit_empty|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Ese email ya está registrado.'
        ],
        'password' => [
            'regex_match' => 'La contraseña debe tener mínimo 8 caracteres, un número y un símbolo.'
        ]
    ];

     protected function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) {
            return $data;
        }

        $pwd = trim((string) $data['data']['password']);

        
        if ($pwd === '') {
            unset($data['data']['password']);
            return $data;
        }

        $data['data']['password'] = password_hash($pwd, PASSWORD_DEFAULT);
        return $data;
    }
    
}