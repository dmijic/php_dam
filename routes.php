<?php

$router->get('/', 'HomeController@index');

//Products
$router->get('/products', 'ProductsController@index');
$router->get('/products/create', 'ProductsController@create');
$router->get('/products/{brand}', 'ProductsController@by_brand');

$router->post('/products', 'ProductsController@store');


//Single product
$router->get('/product/{id}', 'ProductController@index');

$router->put('/product/{id}', 'ProductController@update');

$router->delete('/product/{id}', 'ProductController@destroy');


//Brands
$router->get('/brands', 'BrandsController@index');
$router->get('/brands/create', 'BrandsController@create');

$router->post('/brands', 'BrandsController@store');


//Single brand
$router->get('/brand/{id}', 'BrandController@index');

$router->delete('/brand/{id}', 'BrandController@destroy');



//Ingredients
$router->get('/ingredients', 'IngredientsController@index');
$router->get('/ingredients/create', 'IngredientsController@create');

$router->post('/ingredients', 'IngredientsController@store');


//Claims
$router->get('/claims', 'ClaimsController@index');
$router->get('/claims/create', 'ClaimsController@create');

$router->post('/claims', 'CLaimsController@store');


//Social media
$router->get('/social_media', 'SocialMediaController@index');
$router->get('/social_media/by_brand', 'SocialMediaController@by_brand');
$router->get('/social_media/single_post/{id}', 'SocialMediaController@single_post');
$router->get('/social_media/create', 'SocialMediaController@create');

//Users
$router->get('/my-profile', 'UsersController@index');
$router->get('/my-account', 'UsersController@account');
$router->get('/help', 'UsersController@help');
$router->get('/new-user', 'UsersController@create');

//OpenAI
$router->get('/openaitest/{query}', 'OpenAIController@test');
