<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    Route::resource('users', 'RonAppleton\Radmin\Users\Http\Controllers\UsersController');

    Route::get('users/extra/{method}', config('radmin-users.user_controller') . '@handle');

    Route::group(['prefix' => 'ajax-resources'], function () {
        Route::get('{method}', config('radmin-users.resource_controller') . '@handle');
    });
});