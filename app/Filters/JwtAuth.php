<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getHeaderLine('Authorization');

        if (! $authHeader || ! preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return service('response')->setJSON(['message' => 'Token no proporcionado'])->setStatusCode(401);
        }

        $token = $matches[1];

        try {
            $secret = env('JWT_SECRET');
            $decoded = JWT::decode($token, new Key($secret, 'HS256'));

            // opcional: guardar user en request
            $request->user = $decoded;
        } catch (\Throwable $e) {
            return service('response')->setJSON(['message' => 'Token inválido'])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}
