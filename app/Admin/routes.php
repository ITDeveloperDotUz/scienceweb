<?php

//use App\Admin\Controllers\OrganizationController;
//use App\Admin\Controllers\UserController;
use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('organizations', OrganizationController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('sections', SectionController::class);
    $router->resource('tariffs', TariffController::class);
    $router->resource('client_roles', ClientRoleController::class);
    $router->resource('client_permissions', ClientPermissionController::class);
});


