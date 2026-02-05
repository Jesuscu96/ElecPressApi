<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        
        if ($request->getMethod() === 'options') {
            return;
        }

        $key = env('JWT_SECRET');

        $authHeader = $request->getHeaderLine('Authorization');
        $token = null;

        if ($authHeader && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        }

        if (! $token) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['message' => 'Acceso denegado: token no proporcionado.']);
        }

        try {
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            $request->jwt = $decoded;
        } catch (\Throwable $e) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON(['message' => 'Acceso denegado: token inválido o expirado.']);
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nada
    }
}
