<?php

Route::get('/','HomeController@index');

Route::resource('api/cashflow_events', 'CashflowEventsApiController');

Route::resource('api/cashflow_categories', 'CashflowCategoriesApiController');

Route::resource('api/analytics_data', 'AnalyticsDataApiController');

Route::resource('posts', 'PostsController');

Route::get('users/register', 'UsersController@getRegister');
Route::get('users/{id}', 'UsersController@getShow')->where(array('id' => '[0-9]+'));
Route::post('users/create', 'UsersController@postCreate');
Route::get('users/login', 'UsersController@getLogin');
Route::post('users/signin', 'UsersController@postSignin');
Route::get('users/logout', 'UsersController@getLogout');

Route::controller('password', 'RemindersController');
