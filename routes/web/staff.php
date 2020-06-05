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

    Route::put('staff/{staff}', 'StaffController@update')
        ->name('staff.update');

    Route::delete('staff/{staff}', 'StaffController@destroy')
        ->name('staff.destroy');

});