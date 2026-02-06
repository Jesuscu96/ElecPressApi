<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsersModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends ResourceController
{
    protected $format = 'json';

    public function register()
    {
        $data = $this->request->getJSON(true);
        if (!is_array($data)) {
            $data = $this->request->getPost();
        }


        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
        $first_name = $data['first_name'] ?? '';
        $last_name = $data['last_name'] ?? '';
        $phone = $data['phone'] ?? null;
        $birth_date = $data['birth_date'] ?? null;

        if (!$email || !$password || !$first_name || !$last_name || !$phone || !$birth_date) {
            return $this->failValidationErrors([
                'email' => 'El email es obligatorio.',
                'password' => 'La contraseña es obligatoria.',
                'first_name' => 'El nombre es obligatoria.',
                'last_name' => 'El apellido es obligatoria.',
                'phone' => 'El telefono es obligatoria.',
                'birth_date' => 'La fecha de nacimiento es obligatoria.',
            ]);
        }

        
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}$/', $password)) {
            return $this->failValidationErrors([
                'password' => 'La contraseña debe tener al menos 8 caracteres un numero, un simbolo y una letra minuscula y otra mayuscula .',
            ]);
        }
        if (!preg_match('/^\d{8,15}$/', (string) $phone)) {
            return $this->failValidationErrors('El teléfono debe tener entre 8 y 15 dígitos (solo números).');
        }

        $users = new UsersModel();

        if ($users->where('email', $email)->first()) {
            return $this->failValidationErrors(['email' => 'Ya existe un usuario con ese email.']);
        }

        $insertData = [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role' => $data['role'] ?? 'user',
            'first_name' => $data['first_name'] ?? '',
            'last_name' => $data['last_name'] ?? '',
            'phone' => $phone,
            'birth_date' => $data['birth_date'] ?? null,
        ];

        $id = $users->insert($insertData);
        if (!$id) {
            return $this->failValidationErrors($users->errors());
        }

        unset($insertData['password']);
        $insertData['id'] = $id;

        return $this->respondCreated([
            'message' => 'Usuario registrado correctamente.',
            'user' => $insertData,
        ]);
    }

    public function login()
    {
        $data = $this->request->getJSON(true) ?? $this->request->getPost();

        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (!$email || !$password) {
            return $this->failValidationErrors([
                'email' => 'El email es obligatorio.',
                'password' => 'La contraseña es obligatoria.',
            ]);
        }

        $users = new UsersModel();
        $user = $users->where('email', $email)->first();
        $user['id'] = (int) $user['id'];


        if (!$user || !password_verify($password, $user['password'])) {
            return $this->failUnauthorized('Credenciales incorrectas.');
        }

        $payload = [
            'iss' => 'elecpress',
            'aud' => 'elecpress',
            'iat' => time(),
            'exp' => time() + 3600,
            'sub' => $user['id'],
            'email' => $user['email'],
            'role' => $user['role'] ?? 'user',
        ];

        $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        unset($user['password']);

        return $this->respond([
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function me()
    {
        $authHeader = $this->request->getHeaderLine('Authorization');
        if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return $this->failUnauthorized('Token no proporcionado.');
        }

        try {
            $decoded = JWT::decode($matches[1], new Key(env('JWT_SECRET'), 'HS256'));
            $users = new UsersModel();
            $user = $users->find((int) $decoded->sub);

            if (!$user) {
                return $this->failNotFound('Usuario no encontrado.');
            }

            unset($user['password']);
            return $this->respond(['user' => $user]);
        } catch (\Throwable $e) {
            return $this->failUnauthorized('Token inválido.');
        }
    }
}
