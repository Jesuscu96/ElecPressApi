<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */




$routes->group('api', ['filter' => 'cors'], function($routes) {
    $routes->options('(:any)', function() { return ''; });
    $routes->options('(:any)/(:any)', function() { return ''; });
    $routes->options('(:any)/(:any)/(:any)', function() { return ''; });


    $routes->resource('projects', ['controller' => 'ProjectsController']); //pruebas de funcionamiento
    $routes->post('auth/login', 'AuthController::login');
    $routes->post('auth/register', 'AuthController::register');
    

    $routes->group('', ['filter' => 'jwt'], function($routes) {

        $routes->get('auth/me', 'AuthController::me');
        
        $routes->resource('clients', ['controller' => 'ClientsController']);
        $routes->resource('materials', ['controller' => 'MaterialController']);
        $routes->resource('projects', ['controller' => 'ProjectsController']);
        $routes->resource('users', ['controller' => 'UsersController']);
        $routes->resource('equipment', ['controller' => 'EquipmentController']);


        $routes->resource('material-categories',  ['controller' => 'MaterialCategoriesController']);
        $routes->resource('equipment-categories', ['controller' => 'EquipmentCategoriesController']);

        
        $routes->resource('project-users',      ['controller' => 'ProjectUsersController']);
        $routes->resource('project-materials',  ['controller' => 'ProjectMaterialsController']);
        $routes->resource('project-equipment',  ['controller' => 'ProjectEquipmentController']);
    });
});



//$routes->get('/clients', 'ClientsController::index');
