<?php

Route::group([
    'namespace'  => '\Backpack\PermissionManager\app\Http\Controllers',
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
], function () {
    Route::group(['middleware' => 'has_permission:admin_permissions'], function () {
        CRUD::resource('permission', 'PermissionCrudController');
    });
    Route::group(['middleware' => 'has_permission:admin_roles'], function () {
        CRUD::resource('role', 'RoleCrudController');
    });
});

Route::group([
    'namespace'  => 'App\Http\Controllers\Admin',
	'prefix'     => config('backpack.base.route_prefix', 'admin'),
	'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
], function () {
	Route::group(['middleware' => 'has_permission:admin_users'], function () {
		CRUD::resource('user', 'User\UserCrudController');
	});
});
