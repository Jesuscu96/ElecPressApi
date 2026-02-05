<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Cors implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $response = service('response');

        // Siempre enviar headers
        $response
            ->setHeader('Access-Control-Allow-Origin', 'http://localhost:4200')
            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->setHeader('Access-Control-Allow-Credentials', 'true');

        // Manejar OPTIONS y detener ejecución
        if ($request->getMethod() === 'options') {
            $response->setStatusCode(200);
            $response->setBody('OK'); // opcional
            return $response;
        }

        return null; // continúa normalmente
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Agrega headers también después de la ejecución normal
        return $response
            ->setHeader('Access-Control-Allow-Origin', 'http://localhost:4200')
            ->setHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
            ->setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->setHeader('Access-Control-Allow-Credentials', 'true');
    }
}
