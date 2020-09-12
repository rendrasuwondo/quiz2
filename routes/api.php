<?php

Route::group([

  'middleware' => 'api',
  'prefix' => 'auth',
  'namespace' => 'Auth'

], function ($router) {

  Route::post('register', 'RegisterController');
  Route::post('login', 'LoginController');
  Route::post('logout', 'LogoutController');
});


Route::group([

  'middleware' => 'auth:api',
  'prefix' => 'todo',
  'namespace' => 'Api',

], function ($router) {

  Route::get('/', 'TodoController@index');
  Route::post('/', 'TodoController@store');
  Route::post('/change-done-status/{$id}', 'TodoController@changeDoneStatus');
  Route::post('/delete/{$id}', 'TodoController@delete');
});
