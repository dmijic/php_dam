<?php

$router->get('/', 'HomeController@index');

//Products
$router->get('/products', 'ProductsController@index');
$router->get('/products/by_brand', 'ProductsController@by_brand');
$router->get('/products/single_product', 'ProductsController@single_product');
$router->get('/products/create', 'ProductsController@create');

//Brands
$router->get('/brands', 'BrandsController@index');
$router->get('/brands/create', 'BrandsController@create');

//Ingredients
$router->get('/ingredients', 'IngredientsController@index');
$router->get('/ingredients/create', 'IngredientsController@create');

//Claims
$router->get('/claims', 'ClaimsController@index');
$router->get('/claims/create', 'ClaimsController@create');

//Users
$router->get('/my-profile', 'UsersController@index');
$router->get('/my-account', 'UsersController@account');
$router->get('/help', 'UsersController@help');
$router->get('/new-user', 'UsersController@create');
