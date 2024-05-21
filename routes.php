<?php

use App\Controllers\UsersController;

$router->get('/', 'HomeController@index', ['user']);

//Products
$router->get('/products', 'ProductsController@index', ['user']);
$router->get('/products/create', 'ProductsController@create', ['admin']);
$router->get('/products/{brand}', 'ProductsController@by_brand', ['user']);

$router->post('/products', 'ProductsController@store', ['admin']);


//Single product
$router->get('/product/{id}', 'ProductController@index', ['user']);

$router->put('/product/{id}', 'ProductController@update', ['admin']);

$router->delete('/product/{id}', 'ProductController@destroy', ['admin']);


//Brands
$router->get('/brands', 'BrandsController@index', ['user']);
$router->get('/brands/create', 'BrandsController@create', ['admin']);

$router->post('/brands', 'BrandsController@store', ['admin']);


//Single brand
$router->get('/brand/{id}', 'BrandController@index', ['user']);

$router->put('/brand/{id}', 'BrandController@update', ['admin']);

$router->delete('/brand/{id}', 'BrandController@destroy', ['admin']);



//Ingredients
$router->get('/ingredients', 'IngredientsController@index', ['user']);
$router->get('/ingredients/create', 'IngredientsController@create', ['admin']);

$router->post('/ingredients', 'IngredientsController@store', ['admin']);


//Claims
$router->get('/claims', 'ClaimsController@index', ['user']);
$router->get('/claims/create', 'ClaimsController@create', ['admin']);

$router->post('/claims', 'CLaimsController@store', ['admin']);


//Social media
$router->get('/social_media', 'SocialMediaController@index', ['user']);
$router->get('/social_media/by_brand', 'SocialMediaController@by_brand', ['user']);
$router->get('/social_media/single_post/{id}', 'SocialMediaController@single_post', ['user']);
$router->get('/social_media/create', 'SocialMediaController@store', ['admin']);

//Users
$router->get('/my-profile', 'UsersController@index', ['user']);
$router->get('/new-user', 'UsersController@create', ['guest']);

$router->get('/my-account', 'UsersController@account', ['user']);
$router->get('/help', 'UsersController@help', ['user']);

$router->get('/login', 'UsersController@login', ['guest']);

$router->post('/new-user', 'UsersController@store', ['guest']);
$router->post('/logout', 'UsersController@logout', ['user']);
$router->post('/login', 'UsersController@authenticate', ['guest']);
