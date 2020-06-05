<?php

Route::middleware(['auth', 'onlyCustomerAdmin'])->group(function () {

    Route::get('branches', 'BranchController@index')
        ->name('branches.index');

    Route::get('branches/create', 'BranchController@create')
        ->name('branches.create')
        ->middleware('checkLimitBranchesMiddleware');;

    Route::post('branches', 'BranchController@store')
        ->name('branches.store')
        ->middleware('onlyCustomerAdmin');

    Route::get('branches/{branch}/edit', 'BranchController@edit')
        ->name('branches.edit');

    Route::get('branches/{branch}', 'BranchController@show')
        ->name('branches.show');

    Route::put('branches/{branch}', 'BranchController@update')
        ->name('branches.update');

    Route::delete('branches/{branch}', 'BranchController@destroy')
        ->name('branches.destroy');

});