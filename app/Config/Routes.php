<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/','Authentication::index');

    //Route for Authentication
    $routes->get('/login',                   'Authentication::index',           ['filter'=> 'entryFilter']);
    $routes->get('/register',                'Authentication::registerView',    ['filter'=> 'entryFilter']);
    $routes->post('/register',               'Authentication::register');
    $routes->post('/login',                  'Authentication::login');
    $routes->get('/logout',                  'Authentication::logout',          ['filter'=> 'authFilter']);

//Route for User

    
    $routes->get('/dashboard',                         'User::index',                 ['filter'=>'authFilter']);
    $routes->get('/create-user',                       'User::createUser',            ['filter'=> 'authFilter']);
    $routes->get('/edit-user',                         'User::editUser',              ['filter'=>'authFilter']);
    $routes->post('/edit-by-user',                     'User::editByUser',            ['filter'=>'authFilter']);
    $routes->get('/deactivate-user',                   'User::deactivateUser',        ['filter'=> 'authFilter']);
    $routes->get('/profile',                           'User::myProfile',             ['filter'=> 'authFilter']);
    $routes->post('/edit-profile',                     'User::editProfile',           ['filter'=> 'authFilter']);
    $routes->post('/create-user-by-admin',             'User::createUserByAdmin',     ['filter'=> 'authFilter']);
    $routes->get('/user/getStatesByCountry/(:any)',    'User::getStatesByCountry/$1', ['filter'=> 'authFilter']);
    $routes->get('/user/getCitiesByState/(:any)',      'User::getCitiesByState/$1',   ['filter'=> 'authFilter']);
    $routes->get('/user/getCountriesList',             'User::getCountriesList',      ['filter'=> 'authFilter']);
    $routes->get('/user/getStatesList',                'User::getStatesList',         ['filter'=> 'authFilter']);
    $routes->get('/user/getCitiesList',                'User::getCitiesList',         ['filter'=> 'authFilter']);
    $routes->get('/user/getUserDetails',               'User::getUserDetails',        ['filter'=> 'authFilter']);
    
