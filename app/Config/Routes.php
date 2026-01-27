<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->resource('clients', ['controller' => 'ClientsController']); //pruebas

$routes->group('api', ['filter' => 'cors'], function($routes) {
    $routes->resource('clients', ['controller' => 'ClientsController']); //pruebas
    $routes->post('auth/login', 'AuthController::login');
    $routes->post('auth/register', 'AuthController::register');

    $routes->group('', ['filter' => 'jwt'], function($routes) {

        $routes->get('auth/me', 'AuthController::me');
        $routes->resource('clients', ['controller' => 'ClientsController']);
        $routes->resource('materials', ['controller' => 'MaterialController']);
        $routes->resource('projects', ['controller' => 'ProjectsController']);
        $routes->resource('users', ['controller' => 'UsersController']);
        $routes->resource('equipment', ['controller' => 'EquipmentController']);
        $routes->resource('assigned-projects', ['controller' => 'AssignedProjectsController']);
        $routes->resource('assigned-materials', ['controller' => 'AssignedMaterialsController']);
        $routes->resource('assigned-equipment', ['controller' => 'AssignedEquipmentController']);
    });
});



//$routes->get('/clients', 'ClientsController::index');
