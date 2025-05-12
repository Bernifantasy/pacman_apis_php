<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->post('pacman/v1/create_user', 'ApiController::createUser');
$routes->post('pacman/v1/login', 'ApiController::login');
$routes->post('pacman/v1/logged', 'ApiController::logged' , ['filter' => 'jwt']);
$routes->post('pacman/v1/update_user', 'ApiController::updateUser' , ['filter' => 'jwt']);
$routes->post('pacman/v1/logout', 'ApiController::logout' , ['filter' => 'jwt']);

$routes->post('pacman/v1/create_game', 'ApiController::add_game' , ['filter' => 'jwt']);
$routes->get('pacman/v1/get_user_last_games', 'ApiController::get_user_last_games' , ['filter' => 'jwt']);
$routes->get('pacman/v1/get_user_stats', 'ApiController::get_user_stats' , ['filter' => 'jwt']);




