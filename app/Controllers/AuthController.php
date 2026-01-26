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
        $data = $this->request->getJSON(true) ?? [];

        $email    = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (! $email || ! $password) {
            return $this->failValidationErrors([
                'email' => 'El email es obligatorio.',
                'password' => 'La contraseña es obligatoria.',
            ]);
        }

        $users = new UsersModel();

        if ($users->where('email', $email)->first()) {
            return $this->failValidationErrors(['email' => 'Ya existe un usuario con ese email.']);
        }

        $insertData = [
            'email'      => $email,
            'password'   => password_hash($password, PASSWORD_BCRYPT),
            'role'       => $data['role'] ?? 'user',
            'first_name' => $data['first_name'] ?? '',
            'last_name'  => $data['last_name'] ?? '',
            'phone'      => $data['phone'] ?? '',
            'birth_date' => $data['birth_date'] ?? null,
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $id = $users->insert($insertData);
        if (! $id) {
            return $this->failValidationErrors($users->errors());
        }

        unset($insertData['password']);
        $insertData['id'] = $id;

        return $this->respondCreated([
            'message' => 'Usuario registrado correctamente.',
            'user'    => $insertData,
        ]);
    }

    public function login()
    {
        $data = $this->request->getJSON(true) ?? [];

        $email    = $data['email'] ?? null;
        $password = $data['password'] ?? null;

        if (! $email || ! $password) {
            return $this->failValidationErrors([
                'email' => 'El email es obligatorio.',
                'password' => 'La contraseña es obligatoria.',
            ]);
        }

        $users = new UsersModel();
        $user  = $users->where('email', $email)->first();

        if (! $user || ! password_verify($password, $user['password'])) {
            return $this->failUnauthorized('Credenciales incorrectas.');
        }

        $payload = [
            'iss'   => 'elecpress',
            'aud'   => 'elecpress',
            'iat'   => time(),
            'exp'   => time() + 3600,
            'sub'   => $user['id'],
            'email' => $user['email'],
            'role'  => $user['role'] ?? 'user',
        ];

        $token = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

        unset($user['password']);

        return $this->respond([
            'token' => $token,
            'user'  => $user,
        ]);
    }

    public function me()
    {
        $authHeader = $this->request->getHeaderLine('Authorization');
        if (! preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return $this->failUnauthorized('Token no proporcionado.');
        }

        try {
            $decoded = JWT::decode($matches[1], new Key(env('JWT_SECRET'), 'HS256'));
            $users = new UsersModel();
            $user = $users->find((int) $decoded->sub);

            if (! $user) {
                return $this->failNotFound('Usuario no encontrado.');
            }

            unset($user['password']);
            return $this->respond(['user' => $user]);
        } catch (\Throwable $e) {
            return $this->failUnauthorized('Token inválido.');
        }
    }
}
