<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {

    $router->group(['prefix' => 'products'], function () use ($router) {
        $router->get('/', 'ProductController@index');
        $router->post('/create', 'ProductController@create');
        $router->put('/edit/{id}', 'ProductController@edit');
        $router->delete('/delete/{id}', 'ProductController@delete');
    });

    $router->group(['prefix' => 'penjualan'], function () use ($router) {
        $router->get('/', 'PenjualanController@index');
        $router->post('/create', 'PenjualanController@create');
        $router->put('/edit/{id}', 'PenjualanController@edit');
        $router->delete('/delete/{id}', 'PenjualanController@delete');
    });

    $router->group(['prefix' => 'pembelian'], function () use ($router) {
        $router->get('/', 'PembelianController@index');
        $router->post('/create', 'PembelianController@create');
        $router->put('/edit/{id}', 'PembelianController@edit');
        $router->delete('/delete/{id}', 'PembelianController@delete');
    });
});

// $router->get('api/products', 'ProductController@index');
// $router->post('api/products/create', 'ProductController@create');
// $router->put('api/products/edit/{id}', 'ProductController@edit');
// $router->delete('api/products/delete/{id}', 'ProductController@delete');

// $router->get('api/penjualan', 'PenjualanController@index');
// $router->post('api/penjualan/create', 'PenjualanController@create');
// $router->put('api/penjualan/edit/{id}', 'PenjualanController@edit');
// $router->delete('api/penjualan/delete/{id}', 'PenjualanController@delete');

// $router->get('api/pembelian', 'PembelianController@index');
// $router->post('api/pembelian/create', 'PembelianController@create');
// $router->put('api/pembelian/edit/{id}', 'PembelianController@edit');
// $router->delete('api/pembelian/delete/{id}', 'PembelianController@delete');
