<?php

Route::post('customer', 'CustomerController@store')
    ->name('customer.store');

Route::get('customers', 'CustomerController@index')
    ->name('customers.index');

Route::get('customer/create', 'CustomerController@create')
    ->name('customer.create');

