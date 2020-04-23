<?php

Route::middleware(['auth', 'onlyCustomerAdmin'])->group(function () {

    Route::get('staff', 'StaffController@index')
        ->name('staff.index');

    Route::get('staff/create', 'StaffController@create')
        ->name('staff.create')
        ->middleware('checkLimitStaffMiddleware');;

    Route::post('staff', 'StaffController@store')
        ->name('staff.store');

    Route::get('staff/{staff}/edit', 'StaffController@edit')
        ->name('staff.edit');

    Route::get('staff/{staff}', 'StaffController@show')
        ->name('staff.show');

    Route::put('staff/{branch}', 'StaffController@update')
        ->name('staff.update');

    Route::delete('staff/{branch}', 'StaffController@destroy')
        ->name('staff.destroy');

});