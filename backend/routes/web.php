<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/empresa/{id}', 'EmpresaController@retornaEmpresa');
$router->get('/empresa', 'EmpresaController@retornaTodasEmpresa');
$router->post('/empresa', 'EmpresaController@criaEmpresa');
$router->delete('/empresa/{id}', 'EmpresaController@deletaEmpresa');
$router->put('/empresa/{id}', 'EmpresaController@atualizaEmpresa');