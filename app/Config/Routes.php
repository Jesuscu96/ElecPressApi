<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->resource('clients', ['controller' => 'ClientsController']);
$routes->resource('material', ['controller' => 'MaterialController']);
$routes->resource('project', ['controller' => 'ProjectsController']);
$routes->resource('users', ['controller' => 'UsersController']);
$routes->resource('equipment', ['controller' => 'EquipmentController']);
$routes->resource('assigned_projects', ['controller' => 'AssignedProjectsController']);
$routes->resource('assigned_materials', ['controller' => 'AssignedMaterialsController']);
$routes->resource('assigned_equipment', ['controller' => 'AssignedEquipmentController']);


//$routes->get('/clients', 'ClientsController::index');
