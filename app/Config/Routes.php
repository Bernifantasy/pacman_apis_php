<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// app/Config/Routes.php

$routes->get('/', 'Home::index'); 
$routes->get('/create_user', 'Home::create_user'); 
$routes->get('/login', 'Home::login');
$routes->get('/logged', 'Home::logged');
$routes->get('/update_user', 'Home::update_user');
$routes->get('/logout', 'Home::logout');
$routes->get('/config_game', 'Home::config_game'); 
$routes->get('/update_config_game', 'Home::update_config_game'); 
$routes->get('/create_game', 'Home::create_game'); 
$routes->get('/get_user_last_games', 'Home::get_user_last_games'); 
$routes->get('/get_user_stats', 'Home::get_user_stats');
$routes->get('/get_top_users', 'Home::get_top_users');


$routes->post('pacman/v1/create_user', 'ApiController::createUser');
$routes->post('pacman/v1/login', 'ApiController::login');
$routes->post('pacman/v1/logged', 'ApiController::logged' , ['filter' => 'jwt']);
$routes->post('pacman/v1/update_user', 'ApiController::updateUser' , ['filter' => 'jwt']);
$routes->post('pacman/v1/logout', 'ApiController::logout' , ['filter' => 'jwt']);

$routes->post('pacman/v1/config_game', 'ApiController::config_game', ['filter' => 'jwt']);
$routes->post('pacman/v1/update_config_game', 'ApiController::update_Config_Game', ['filter' => 'jwt']);



$routes->post('pacman/v1/create_game', 'ApiController::add_game' , ['filter' => 'jwt']);
$routes->get('pacman/v1/get_user_last_games', 'ApiController::get_user_last_games' , ['filter' => 'jwt']);
$routes->get('pacman/v1/get_user_stats', 'ApiController::get_user_stats' , ['filter' => 'jwt']);
$routes->get('pacman/v1/get_top_users', 'ApiController::get_top_users');



$routes->options('pacman/v1/(:any)', static function(){});

