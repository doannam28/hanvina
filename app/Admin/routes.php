<?php

use App\Admin\Controllers\AboutPageController;
use App\Admin\Controllers\BookingController;
use App\Admin\Controllers\ContractPageController;
use App\Admin\Controllers\CustomerController;
use App\Admin\Controllers\EmailController;
use App\Admin\Controllers\HomePageController;
use App\Admin\Controllers\NewsPageController;
use App\Admin\Controllers\PostController;
use App\Admin\Controllers\TaxonomyController;
use App\Admin\Controllers\TaxonomyItemController;
use App\Admin\Controllers\TourController;
use App\Admin\Controllers\UploadController;
use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->resource('taxonomies', TaxonomyController::class);
    $router->resource('taxonomy-items', TaxonomyItemController::class);
    $router->resource('/locations', TaxonomyItemController::class);
    $router->resource('/way-tours', TaxonomyItemController::class);
    $router->resource('home-page', HomePageController::class);
    $router->resource('news-page', NewsPageController::class);
    $router->put('home-page/1/edit/{id}', [HomePageController::class, 'updatePosition']);
    $router->resource('about-page', AboutPageController::class);
    $router->resource('contact-page', ContractPageController::class);
    $router->resource('tour-page', \App\Admin\Controllers\TourPageController::class);
    $router->resource('posts', PostController::class);
    $router->resource('tours', TourController::class);
    $router->resource('customers', CustomerController::class);
    $router->resource('bookings', BookingController::class);
    $router->resource('register-phone', EmailController::class);
    $router->resource('settings', \App\Admin\Controllers\SettingsController::class);
    $router->get('/', 'HomeController@index')->name('home');
});
