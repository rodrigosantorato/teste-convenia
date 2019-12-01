<?php

Route::resource('companies', 'CompaniesController', ['only' => 'store']);
Route::resource('companies.suppliers', 'SuppliersController', ['except' => ['create', 'edit']]);
Route::post('companies/{company}/token', 'ApiTokenController@create');
Route::get('companies/{company}/total', 'SuppliersController@total');
