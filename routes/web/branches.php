<?php

Route::middleware('auth')->group(function (){
    Route::resource('branches', 'BranchController');
});