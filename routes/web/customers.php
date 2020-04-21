<?php

Route::post('customer', 'CustomerController@store')
    ->name('customer.store');

Route::get('customers', 'CustomerController@index')
    ->name('customers.index');

